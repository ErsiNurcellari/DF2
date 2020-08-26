<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;

class AdminEmailTemplateController extends Controller {

    protected $data;

    public function __construct( Request $request ) {

        $this->data['title']        = 'Services';
        $this->data['categories']   = CategoryList();
        if ( $request->input('s') ) {
            $s = $request->input('s');
            $this->data['services'] = Service::latest('id')->where(function ($query) use ( $s ){
                $query->where('title', 'LIKE', '%'.$s.'%')
                    ->orWhere('description', 'LIKE', '%'.$s.'%');
            })->paginate(2);
        } else {
            $this->data['services'] = Service::latest('id')->paginate(15);
        }

    }

    public function index() {
        return view('admin.service.index', $this->data);
    }

    public function create(Request $request) {
        $this->data['title']        = 'Add new Service';
        return view('admin.service.create', $this->data);
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required'
        ]);
        
        $generalFields = $request->except(['service_meta', 'term_list']);
        $generalFields['status'] = (isset($generalFields['save'])) ? 'draft' : 'publish';
        
        unset($generalFields['publish']);
        
        if ( $generalFields['price'] == "" ) {
            $generalFields['price'] = 0.00;
        }

        $service = \Auth::user()->services()->create($generalFields);

        if (!isset($service->id)) {
            \App::abort(500, 'The Service was not saved. Please try again!');
        }

        $this->syncMeta($request, $service);

        $this->syncTerms($request, $service);

        Flash::success('Service added successfully.');

        //event( new \App\Events\SomeEvent($service));

        return redirect()->route('ch-admin.service.edit', [$service->id]);
    }



    public function edit($id) {

        $this->data['title']        = 'Edit Service';
        $this->data['service'] = Service::findOrFail($id);
        return view('admin.service.edit', $this->data);
        
    }



    public function update(Request $request, $id) {
        
        $service = Service::findOrFail($id);
        
        $generalFields              = $request->except(['service_meta', 'term_list']);
        $generalFields['status']    = (isset($generalFields['save'])) ? 'draft' : 'publish';

        $service->update($generalFields);

        $this->syncMeta($request, $service);

        $this->syncTerms($request, $service);

        Flash::success('Service updated successfully.');

        return redirect()->route('ch-admin.service.edit', [$id]);
    }



    public function destroy( $id ) {

        $service = Service::findOrFail($id);
        $service->delete();

        Flash::message('Service#'.$id.' deleted successfully.');

        return redirect()->route('ch-admin.service.index');
    }





    private function syncMeta(Request $request, $service) {

        $service_meta = $request->input('service_meta');

        if ( !isset($service_meta['service_images']) ) {
          $service_meta['service_images'] = '';
        }
        
        //dd($service_meta);
        
        if ( array_key_exists( 'variable_pricing_enabled', $service_meta ) === false ) {
            $service_meta['variable_pricing_enabled'] = 0;
            unset( $service_meta['variable_prices'] );
        }
        
        // Loop through all the meta keys we're looking for
        foreach ($service_meta as $key => $value) {
            // Query for the meta model for the user and key

            $newMeta = new \App\Models\ServiceMeta(['key' => $key]);
            $meta = $service->meta()->where('key', $key)->first() ? : $newMeta->service()->associate($service);

            if (is_array($value)) {
                $value = serialize($value);
            }

            $meta->value = $value;
            $meta->save();

        }
    }



    private function syncTerms(Request $request, $service) {
        $term_list = $request->input('term_list');
        if (!is_null($term_list)) {
            $service->terms()->sync($term_list);
        }  
    }

}
