<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addon;
use App\Services\FormService;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\Product\ProductCreateRequest;

class AdminServiceController extends Controller
{

    protected $data;

    private $productService;

    public function __construct(Request $request, ProductService $productService, FormService $formService)
    {
        $this->productService = $productService;

        $this->data['title'] = 'Services';
        $this->data['categories'] = CategoryList();
        $this->data['forms'] = $formService->all()->pluck('name', 'id');
        $this->data['addons'] = Addon::pluck('name', 'id')->all();
        $addons_sorted = [];
        if (!empty($this->data['addons'])) {
            foreach ($this->data['addons'] as $id => $label) {
                $addons_sorted[] = array('label' => $label, 'value' => $id);
            }
        }

        $this->data['addons'] = json_encode($addons_sorted);

        if ($request->input('s')) {
            $s = $request->input('s');
            $this->data['services'] = Product::latest('id')->where(function ($query) use ($s) {
                $query->where('title', 'LIKE', '%' . $s . '%')
                    ->orWhere('description', 'LIKE', '%' . $s . '%');
            })->paginate(15);
        } else {
            $this->data['services'] = Product::latest('id')->paginate(15);
        }

    }

    public function index()
    {
        return view('admin.service.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['title'] = 'Add new Service';
        return view('admin.service.create', $this->data);
    }

    /**
     *
     * @param ProductCreateRequest $request
     * @return type
     */
    public function store(ProductCreateRequest $request)
    {
        $request['user_id'] = auth()->user()->getAuthIdentifier();

        $service = $this->productService->create($request->all());

        return redirect()->route('ch-admin.service.edit', [$service->id]);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Service';
        $this->data['service'] = $this->productService->find($id);
        $this->data['gallery'] = json_encode($this->data['service']->getMedia('gallery')->map(function ($media){
            return [
                'id' => $media->id,
                'name' => $media->filename . '.' . $media->extension,
                'image_url' => $media->getUrl('thumbnail'),
                'size' => $media->size
            ];
        }));

        $this->data['attachments'] = json_encode($this->data['service']->getMedia('attachments')->map(function ($media){
            return [
                'id' => $media->id,
                'name' => $media->filename . '.' . $media->extension,
                'image_url' => $media->getUrl('thumbnail'),
                'size' => $media->size
            ];
        }));

        return view('admin.service.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $request['user_id'] = auth()->user()->getAuthIdentifier();

        $service = $this->productService->update($request->all(), $id);

        Flash::success('Service updated successfully. <a target="_blank" href="' . url('service/' . $service->slug) . '">View service</a>');

        return redirect()->route('ch-admin.service.edit', [$service->id]);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);

        Flash::message('Service#' . $id . ' deleted successfully.');

        return redirect()->route('ch-admin.service.index');
    }

}
