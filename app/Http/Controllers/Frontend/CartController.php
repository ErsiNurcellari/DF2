<?php

namespace App\Http\Controllers\Frontend;

use App\Events\Order\OrderCreated as OrderCreatedEvent;
use App\Models\Form;
use App\Models\Gateway;
use App\Notifications\Order\OrderCreated;
use App\Models\Addon;
use App\Models\Order;
use App\Models\Role;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\OrderItemMeta;
use App\Models\User;
use App\Models\OrderMeta;
use App\Models\VerifyUser;
use App\Notifications\Order\OrderUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use \App\Models\Tax;
use App\Models\Country;
use App\Services\CartService;
use MediaUploader;
use File;

class CartController extends Controller
{
    /**
     * @var cart
     */
    private $cart;
    
    public function __construct(CartService $cart) {
        $this->cart = $cart;
        $this->upload_path = (string)'local/'.date('Ym');
    }
    
    public function show(Request $request)
    {
        if ($this->cart->countItems() < 1) {
            return redirect('/');
        } 
        
        $user_state = $user_country = 0;
        $countries = Country::all();
        $states = collect([]);
        
        $this->cart->refresh();
                
        if ( \Auth::check() ) {
            $user = \Auth::user();
            
            $states = (isset(\Auth::user()->billing_country->states)) ? \Auth::user()->billing_country->states : collect([]);
            
            $user_state   = $user->billing_state ?? 0;
            $user_country = $user->billing_country->id ?? 0;
        }
        
        $cartItems = $this->cart->getCartItemsTransformed();
        $service = $cartItems->first()->model;
        $cart = $this->cart;

        $title = trans('cart.order_details');

        return view('themes.default.cart', compact( 'service', 'countries', 'states', 'cart', 'user_state', 'user_country', 'title'));

    }

    /**
     * @todo make this more robust.
     * 
     * @param Request $request
     * @return type
     */
    public function update(Request $request) 
    {
        $serviceItem = $this->cart->getCartItems()->first();

        if (!isset($serviceItem->id)) {
            return;
        }
        
        if ( $request->input('billing_country') || $request->input('billing_state') ) {
            $this->cart->updateTax($request->input('billing_country'), $request->input('billing_state'));
        }
        
        foreach ($this->cart->getCartItems() as $key => $item) {
            if ( $item->model instanceof Addon ) {
                $this->cart->removeToCart($item->rowId);
            }
        }


        
        try {
            $service = Product::find($serviceItem->id);

            if (!empty($request->input('addons'))) {
                foreach ($request->input('addons') as $addon) {
                    $addonModel = $service->addons()->wherePivotIn('addon_id', [$addon])->get()->first();

                    $this->cart->addToCart($addonModel->id, 'Addon: '.$addonModel->name, 1, $addonModel->pivot->price, ['addon']);
                }
            }
        } catch (\Exception $ex) {
            return response()->json('Error: '.$ex->getMessage(), 422);
        }
       
        
        return response()->view('core.order.summary', ['cart' => $this->cart, 'service' => $service]);
    }

    public function store(Request $request)
    {
        $this->cart->clearCart();

        $product = Product::findOrFail($request->input('item_id'));
        
        $this->cart->addToCart($product->id, $product->title, 1, $product->price, ['service']);
        
        return redirect()->route('ch_cart');
    }

    public function upload(Request $request)
    {
        if (!$request->input('form_id') || !$request->input('input_name')) {
            die('here');
        }

        $form = Form::findOrFail($request->input('form_id'));

        $input = collect(json_decode($form->raw_content))->where('name', $request->input('input_name'))->first();

        $allowed_type = !empty($input->allowed_types) ? explode(', ', $input->allowed_types) : '';

        $file = $request->file('file');

        try {
            $media = MediaUploader::fromSource($file)
                ->toDestination('local', $this->upload_path)
                ->setAllowedExtensions($allowed_type)
                ->upload();
        } catch ( \Exception $exception ) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }


        if( $media->aggregate_type == 'image' ) {
            foreach (config('media.sizes') as $name => $size) {

                $width = ($name != 'medium') ? $size[0] : null;
                $height = $size[1];

                $resized_filename = $media->filename . '.' . $media->extension;
                $abs_path = $media->directory . '/' . $name . '/';

                if (!File::exists(storage_path('app/'.$abs_path))) {
                    try {
                        File::makeDirectory(storage_path('app/'.$abs_path));
                    } catch (\Exception $exception) {
                        die($exception->getMessage());
                    }

                }

                Image::make(storage_path('app/'.$media->getDiskPath()))
                    ->resize($width, $height, function( $constraint ){
                        $constraint->aspectRatio();
                    })->save(storage_path('app/'.$abs_path . $resized_filename));

                $media->meta()->updateOrCreate(['size_name' => $name], ['path' => $abs_path . $resized_filename]);
            }
        }

        return response()->json($media->id, 200);
    }
}
