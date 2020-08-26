<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Term;
use Illuminate\Http\Request;
use Setting;
use Storage;

class HomeController extends Controller
{

    public function index() {
        $services = Product::latest('id')->paginate(setting('services.per_page', 8));
        return view('themes.default.index', compact('services'));
    }

    public function category($slug)
    {
        if($slug)
        {
            $slug = explode('/', utf8_uri_encode($slug));
        }

        $terms = Term::whereIn('slug', [end($slug)])->get();

        if ($terms->count() < 1) {
            abort(404);
        }

        $term = $terms->pluck('id')->toArray();

        $query = Product::latest('id')->whereHas('terms', function ($q) use ($term) {
            $q->whereIn('term_id', $term);
        });

        $data['term'] = $terms->where('slug', collect($slug)->last())->first();
        $data['title'] = $data['term']->name;
        $data['description'] = $data['term']->description;
        $data['services'] = $query->paginate(setting('services.per_page', 8));
        return view('themes.default.index', $data);
    }

    public function attachment($id)
    {
        return Storage::disk('local')->download(decrypt($id));
    }

    public function search(Request $request)
    {
        $query = Product::where('title', 'LIKE', "%{$request->q}%")
            ->orWhere('description', "LIKE", "%{$request->q}%");

        $data['q'] = $request->q;
        $data['services'] = $query->paginate(setting('services.per_page', 8));
        $data['title'] = trans('results_found', ['count' => $data['services']->total(), 'q' => $data['q']]);
        return view('themes.default.index', $data);
    }
}
