<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Notifications\Order\PreOrderQueryNotification;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($id)
    {
        $service = Product::findBySlugOrFail($id);
        $title = ($service->getMeta('seo_title')) ? $service->getMeta('seo_title') : $service->title;
        $description = ($service->getMeta('seo_description')) ? $service->getMeta('seo_description') : null;
        return view('themes.default.single', compact('service', 'title', 'description'));
    }

    public function pre_order_query(Request $request)
    {
        $rules = [
            'item_id' => 'required|exists:products,id',
            'message' => 'required',
        ];

        if (!auth()->check()) {
            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
        }

        $request->validate($rules);

        try {
            $service = Product::find($request->item_id);

            if (auth()->check()) {

                $user = auth()->user();

                $name = "{$user->first_name} {$user->last_name}";
                $email = $user->email;
            } else {
                $name = $request->name;
                $email = $request->email;
            }

            $data = [
                'service_name' => $service->title,
                'url' => route('ch_service_single', [$service->slug]),
                'name' => $name,
                'email' => $email,
                'content' => $request->message,
            ];

            $admins = User::whereHas('roles', function ($query) {
                $query->whereName('administrator');
            })->get();

            foreach ($admins as $admin) {
                $admin->notify(new PreOrderQueryNotification($data));
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => trans('service_detail.pre_order_failed_message')
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => trans('service_detail.pre_order_success_message')
        ]);
    }
}
