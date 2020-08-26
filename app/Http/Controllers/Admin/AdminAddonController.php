<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\Services\AddonService;


class AdminAddonController extends Controller
{

    protected $data = [];

    public function __construct(Request $request, AddonService $AddonService)
    {
        $this->AddonService = $AddonService;

        $this->data['title'] = 'Addons';
        if ( $request->input('s') ) {
            $s = $request->input('s');
            $this->data['addons'] = Addon::latest('id')->where(function ($query) use ( $s ){
                $query->where('name', 'LIKE', '%'.$s.'%')
                    ->orWhere('description', 'LIKE', '%'.$s.'%');
            })->paginate(15);
        } else {
            $this->data['addons'] = Addon::latest('id')->paginate(15);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.addon.create', $this->data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        return view('admin.addon.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:addons'
        ]);

        try {
            $addon = $this->AddonService->create($request->all());
        } catch (\Exception $ex) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($ex->getMessage());
        }

        if (!isset($addon->id)) {
            \App::abort(500, 'The Addon was not saved. Please try again!');
        }
        
        Flash::success('Addon added successfully.');
        return redirect()->route('ch-admin.addon.edit', [$addon->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addon = Addon::findOrFail($id);
        $this->data['title'] = 'Edit Addon';
        $this->data['addon'] = $addon;
        return view('admin.addon.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|unique:addons,name,'.$id
        ]);

        $addon = $this->AddonService->update($request->all(), $id);


        Flash::success('Addon updated successfully.');

        return redirect()->route('ch-admin.addon.edit', [$id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ( $this->AddonService->delete($id)  ) {
            
            Flash::success('Addon deleted successfully.');

            return redirect()->route('ch-admin.addon.index');

        } else {
            return redirect()->back()->withErrors('Operation failed. Please try again.');
        }

    }
}
