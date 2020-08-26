<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Http\Controllers\Controller;
use App\Models\Gateway;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderMeta;
use App\Models\Product;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\VerifyUser;
use App\Notifications\Order\OrderCreated;
use App\Notifications\Order\OrderUpdated;
use App\Services\CartService;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Hook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Swift_TransportException;

class OrderController extends Controller
{
    /**
     * @var cart
     */
    private $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function submit(Request $request)
    {

        if ($this->cart->getCartItems()->count() > 0) {

            $purchased_items = [];

            foreach ($this->cart->getCartItems() as $row) {
                $purchased_items[] = [
                    'name' => $row->name,
                    'price' => round($row->total, 2, PHP_ROUND_HALF_DOWN),
                    'quantity' => $row->qty
                ];
            }

        } else {

            App::abort(422, trans('cart.no_service_selected'));

        }

        $rules['first_name'] = 'required|string|max:255';
        $rules['last_name'] = 'required|string|max:255';
        $rules['usermeta.billing_address'] = 'required|string|max:255';
        $rules['usermeta.billing_city'] = 'required|string|max:255';
        $rules['usermeta.billing_zip'] = 'required|string|max:255';
        $rules['usermeta.billing_country'] = 'required';
        $rules['usermeta.billing_state'] = 'required';

        $request->validate($rules);


        $input = $request->all();


        \Auth::user()->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name']
        ]);

        $this->syncBilling($request, \Auth::user());


        $order = \Auth()->user()->orders()->create([]);

        foreach ($this->cart->getCartItems() as $row) {

            if ($row->model instanceof Product) {
                $item = new OrderItem([
                    'item_id' => $row->id,
                    'item_type' => 'line_item'
                ]);

                $item->order()->associate($order)->save();

                $item->meta()->create([
                    'key' => '_service_id',
                    'value' => $row->id
                ]);

                $downloads = $row->model->getMedia('attachments')->pluck('id')->toArray();

                if (sizeof($downloads) > 0) {
                    $order->syncMedia($downloads, 'downloads');
                }

            } else {
                $item = new OrderItem([
                    'item_id' => $row->id,
                    'item_type' => 'addon'
                ]);

                $item->order()->associate($order)->save();
            }

            $item->meta()->create([
                'key' => '_item_name',
                'value' => $row->name
            ]);

            $item->meta()->create([
                'key' => '_subtotal',
                'value' => $row->price
            ]);

            $item->meta()->create([
                'key' => '_qty',
                'value' => $row->qty
            ]);

            $item->meta()->create([
                'key' => '_tax_rate',
                'value' => $row->taxRate
            ]);

            $item->meta()->create([
                'key' => '_total',
                'value' => $row->total
            ]);

        }

        $orderMetaData = [
            [
                'key' => 'billing_first_name',
                'value' => $request->input('first_name')
            ],
            [
                'key' => 'billing_last_name',
                'value' => $request->input('last_name')
            ],
            [
                'key' => 'billing_address',
                'value' => $request->input('usermeta.billing_address')
            ],
            [
                'key' => 'billing_city',
                'value' => $request->input('usermeta.billing_city')
            ],
            [
                'key' => 'billing_zip',
                'value' => $request->input('usermeta.billing_zip')
            ],
            [
                'key' => 'billing_country',
                'value' => $request->input('usermeta.billing_country')
            ],
            [
                'key' => 'billing_state',
                'value' => $request->input('usermeta.billing_state')
            ],
            [
                'key' => '_payment_method',
                'value' => $request->input('payment_method')
            ],
            [
                'key' => '_transaction_id',
                'value' => ''
            ],
            [
                'key' => '_customer_ip_address',
                'value' => bwpc_get_client_ip()
            ],
            [
                'key' => '_customer_user_agent',
                'value' => $_SERVER['HTTP_USER_AGENT']
            ],
            [
                'key' => '_order_currency',
                'value' => setting('currency', 'USD')
            ],
            [
                'key' => '_order_total',
                'value' => Cart::total()
            ],
            [
                'key' => '_tax_total',
                'value' => Cart::tax()
            ],
            [
                'key' => '_tax_rate',
                'value' => get_tax_rate()
            ],
            [
                'key' => '_order_subtotal',
                'value' => Cart::subtotal()
            ]
        ];

        $orderMetaData = Hook::get('before_order_meta_save', [$orderMetaData, $request], function ($orderMetaData) {
            return $orderMetaData;
        });

        foreach ($orderMetaData as $meta) {
            $orderMeta = new OrderMeta([
                'key' => $meta['key'],
                'value' => $meta['value']
            ]);

            $orderMeta->order()->associate($order)->save();
        }


        Session::put('order', $order->id);

        Session::save();

        if ($request->has('form_data')) {

            $product_id = $this->cart->getCartItems()->first()->id;

            $product = Product::find($product_id);

            $form = collect(json_decode($product->form->raw_content, true));

            $insert = [];
            $insertFormData = [];

            foreach ($request->form_data as $key => $value) {

                $input = $form->where('name', $key)->first();

                $insert['label'] = strip_tags($input['label']);
                $insert['type'] = strip_tags($input['type']);
                $insert['value'] = is_array($value) ? implode(',', $value) : $value;

                $insertFormData[] = $insert;
            }

            $order->customFields()->createMany($insertFormData);
        }

        // Free Items
        if ($this->cart->getCartItems()->first()->model->price == 0) {

            Cart::destroy();

            $status = 'processing';

            $order->update(['status' => $status]);

            return redirect(route('ch_order_submitted', [$order->id]));
        }

        $payment_methods = [
            'paypal' => 'PayPal_Express',
            'stripe' => 'Stripe',
            'razorpay' => 'Razorpay_Checkout',
            'offline_payments' => 'Offline Payments'
        ];

        $payment_method_key = $request->input('payment_method');
        $payment_method = $payment_methods[$request->input('payment_method')];

        if ($payment_method_key == 'offline_payments') {

            Cart::destroy();

            $status = 'processing';

            $order->update(['status' => $status]);

            return redirect(route('ch_order_submitted', [$order->id]));
        }

        if ($payment_method_key == 'razorpay') {
            $order->update(['status' => 'pending']);

            $displayCurrency = setting('currency', 'USD');

            try {
                $mode = setting('razorpay.sandbox_mode') == 'yes' ? 'sandbox' : 'live';
                $razorClient = new Api(setting('razorpay.'.$mode.'.ki'), setting('razorpay.'.$mode.'.sk'));

                $razorOrder = $razorClient->order->create([
                    'receipt'         => $order->id,
                    'amount'          => (int)(Cart::total() * 100), // amount in the smallest currency unit
                    'currency'        => $displayCurrency,// <a href="https://razorpay.freshdesk.com/support/solutions/articles/11000065530-what-currencies-does-razorpay-support" target="_blank">See the list of supported currencies</a>.)
                    'payment_capture' => '1'
                ]);

                $razorpayOrderId = $razorOrder['id'];

                $amount = $razorOrder['amount'];

                $order->order_details()->updateOrCreate(['key' => 'razorpay_order_id'], ['value' => $razorpayOrderId]);
                $order->order_details()->updateOrCreate(['key' => 'razorpay_order_amount'], ['value' => $amount]);
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }

            Cart::destroy();

            return redirect()->route('ch_pay_form', $order->id);
        }

        $mode = setting($payment_method_key . '.sandbox_mode') == 'yes' ? 'sandbox' : 'live';

        $description = implode(', ', array_map(function ($el) {
            return $el['name'] . ' (' . ch_format_price($el['price']) . ')';
        }, $purchased_items));

        if ($payment_method_key == 'paypal') {
            $gateway = Omnipay::create($payment_method);

            // Send purchase request
            $response = $gateway->purchase(
                [
                    'amount' => Cart::total(2, '.', ''),
                    'currency' => setting('currency', 'USD'),
                    'username' => setting("paypal.{$mode}.username"),
                    'password' => setting("paypal.{$mode}.password"),
                    'signature' => setting("paypal.{$mode}.signature"),
                    'testMode' => setting('paypal.sandbox_mode') == 'yes' ? true : false,
                    'returnUrl' => route('ch_order_submitted', [$order->id]),
                    'cancelUrl' => route('ch_order_cancel', [$order->id]),
                    'notifyUrl' => route('ch_ipn', ['gateway' => 'PayPal', 'order_id' => $order->id]),
                    'transactionId' => $order->id
                ]
            )->setItems($purchased_items)->send();
        } elseif ($payment_method_key == 'stripe') {
            $gateway = Omnipay::create($payment_method);

            $token = $_POST['stripeToken'];
            $response = $gateway->purchase([
                'amount' => Cart::total(2, '.', ''),
                'currency' => setting('currency', 'USD'),
                'apiKey' => setting("stripe.{$mode}.sk"),
                'token' => $token,
                'description' => $description
            ])->setItems($purchased_items)->send();

        }

        // Process response
        if ($response->isSuccessful()) {
            Cart::destroy();

            $status = 'processing';
            $tx_id = $response->getTransactionReference();

            if ($payment_method_key == 'coinpayments') {
                $status = 'pending';
                $tx_id = $response->getTransactionId();
            }

//            // Payment was successful
            $order->update(['status' => $status]);
            $meta = $order->order_details()->where('key', '_transaction_id')->first();
            $meta->value = $tx_id;
            $meta->save();

            try {
                $order->user->notify(new OrderUpdated($order));
            }catch (Swift_TransportException $exception) { }

            return redirect(route('ch_order_submitted', [$order->id]));

        } elseif ($response->isRedirect()) {
            Cart::destroy();
            // Redirect to offsite payment gateway
            $response->redirect();
        } else {
            $order->update(['status' => 'failed']);
            echo $response->getMessage();
        }
//
        exit;


    }


    public function ipn(Request $req, $gateway)
    {

        if ($gateway == 'paypal') {
            $this->paypal_ipn($gateway);
        }
    }

    private function paypal_ipn($gateway)
    {
        $order_id = 0;

        if (isset($_REQUEST['invoice'])) {
            $order_id = intval($_REQUEST['invoice']);
        }

        $mode = setting('paypal.sandbox_mode') == 'yes' ? '.sandbox' : '';

        $order = Order::findOrFail($order_id);

        if (strtolower($gateway == 'paypal')) {

            $raw_post_data = file_get_contents('php://input');
            $raw_post_array = explode('&', $raw_post_data);
            $myPost = array();
            foreach ($raw_post_array as $keyval) {
                $keyval = explode('=', $keyval);
                if (count($keyval) == 2)
                    $myPost[$keyval[0]] = urldecode($keyval[1]);
            }

            // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'

            $req = 'cmd=_notify-validate';
            if (function_exists('get_magic_quotes_gpc')) {
                $get_magic_quotes_exists = true;
            }
            foreach ($myPost as $key => $value) {
                if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                    $value = urlencode(stripslashes($value));
                } else {
                    $value = urlencode($value);
                }
                $req .= "&$key=$value";
            }

            // Step 2: POST IPN data back to PayPal to validate
            $ch = curl_init('https://ipnpb' . $mode . '.paypal.com/cgi-bin/webscr');
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
            // In wamp-like environments that do not come bundled with root authority certificates,
            // please download 'cacert.pem' from "https://curl.haxx.se/docs/caextract.html" and set
            // the directory path of the certificate as shown below:
            // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
            if (!($res = curl_exec($ch))) {
                // error_log("Got " . curl_error($ch) . " when processing IPN data");
                curl_close($ch);
                exit;
            }
            curl_close($ch);


            if (strcmp($res, "VERIFIED") == 0) {

                if (strtolower($_POST['payment_status']) == 'completed') {
                    $order->update(['status' => 'processing']);
                    $meta = $order->order_details()->where('key', '_transaction_id')->first();
                    $meta->value = $_REQUEST['txn_id'];
                    $meta->save();

                    $to_user = User::find($order->user->id)->first();
                    $to_user->notify(new OrderUpdated($order));

                } else {
                    $order->update(['status' => 'failed']);
                }
            } else if (strcmp($res, "INVALID") == 0) {
                // IPN invalid, log for manual investigation
                echo "The response from IPN was: <b>" . $res . "</b>";
            }

        }
    }


    public function completed(Request $request, $id)
    {
        if (!is_null(session('order'))) {
            $order = Auth::user()->orders()->find($request->session()->get('order'));
            $request->session()->forget('order');
            Session::save();

            try {
                // Notify the user.
                $admins = User::whereHas('roles', function ($query) {
                    $query->whereName('administrator');
                })->get();

                // Notify the user.
                $admins = User::whereHas('roles', function ($query) {
                    $query->whereName('administrator');
                })->get();

                foreach ($admins as $admin) {
                    $admin->notify(new OrderCreated($order));
                }

                \Auth::user()->notify(new OrderCreated($order));
            } catch (Swift_TransportException $exception) { }

            if (strtolower($order->PaymentMethod()) == 'paypal') {
                $mode = setting('paypal.sandbox_mode') == 'yes' ? 'sandbox' : 'live';
                $gateway = Omnipay::create('PayPal_Express');
                $gateway->initialize(array(
                    'username' => setting("paypal.{$mode}.username"),
                    'password' => setting("paypal.{$mode}.password"),
                    'signature' => setting("paypal.{$mode}.signature"),
                    'testMode' => setting('paypal.sandbox_mode') == 'yes' ? true : false,
                ));
                // Send purchase request
                $response = $gateway->completePurchase(
                    ['amount' => number_format((float)$order->total(), 2),
                        'currency' => 'USD',
                        'transactionId' => $order->id
                    ]
                )->send();
            }
        } else {
            $order = Auth::user()->orders()->find($id);
        }

        $title = trans('order.thank_you.heading');

        return view('themes.default.thankyou', compact('order', 'title'));
    }


    public function cancel(Request $request, $id)
    {
        if (!is_null(session('order'))) {
            $order = \Auth::user()->orders()->find($request->session()->get('order'));
            $order->update(['status' => 'cancelled']);;
            $request->session()->forget('order');
            Session::save();
            $title = trans('order.cancelled');
            return view('themes.default.cancel', compact('order', 'title'));
        } else {
            return redirect('/');
        }
    }


    public function failed(Request $request, $id)
    {
        if (!is_null(session('order'))) {
            $order = \Auth::user()->orders()->find($request->session()->get('order'));
            $order->update(['status' => 'failed']);;
            $request->session()->forget('order');
            Session::save();
            $failed = true;
            $title = trans('order.failed');
            return view('themes.default.cancel', compact('order', 'failed', 'title'));
        } else {
            return redirect('/');
        }
    }

    public function showPaymentForm($id)
    {
        $order = \auth()->user()->orders()->findOrFail($id);

        if ($order->getMeta('_payment_method') == 'razorpay' && $order->status == 'pending') {

            $addons = '';
            if( $order->items->where('item_type', 'addon')->count() > 0 ) :
                $addons_array = [];
                foreach ( $order->items->where('item_type', 'addon') as $addon ) :
                    $addons_array[] = $addon->name();
                endforeach;
                $addons = ' ('.implode(',', $addons_array).')';
            endif;

            $paymentData = [
                "key"               => setting('razorpay.sandbox.ki'),
                "amount"            => $order->getMeta('razorpay_order_amount'),
                "name"              => setting('app.name'),
                "description"       => $order->items->first()->name().$addons,
                "image"             => get_logo_url(),
                "prefill"           => [
                    "email"             => \auth()->user()->email,
                ],
                "notes"             => [
                    "merchant_order_id" => $order->id,
                ],
                "order_id"          => $order->getMeta('razorpay_order_id'),
            ];

            return view('themes.default.pay', compact('order', 'paymentData'));
        } else {
            abort(404);
        }
    }

    public function verifyPayment($id)
    {
        if (\request('razorpay_signature') && \request('razorpay_payment_id') ) {

            $mode = setting('razorpay.sandbox_mode') == 'yes' ? 'sandbox' : 'live';
            $razorClient = new Api(setting('razorpay.'.$mode.'.ki'), setting('razorpay.'.$mode.'.sk'));
            
            $success = true;
            $order = Order::findOrFail($id);
            try
            {
                $attributes = array(
                    'razorpay_order_id' => $order->getMeta('razorpay_order_id'),
                    'razorpay_payment_id' => \request('razorpay_payment_id'),
                    'razorpay_signature' => \request('razorpay_signature')
                );

                $razorClient->utility->verifyPaymentSignature($attributes);
            } catch(SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }

            if ($success == true) {

                $tx_id = \request('razorpay_payment_id');


                $order->update(['status' => 'processing']);

                $meta = $order->order_details()->where('key', '_transaction_id')->first();
                $meta->value = $tx_id;
                $meta->save();

                try {
                    $order->user->notify(new OrderUpdated($order));
                }catch (Swift_TransportException $exception) { }

                return redirect(route('ch_order_submitted', [$order->id]));
            } else {
                $order->update(['status' => 'failed']);

                return redirect(route('ch_order_failed', [$order->id]));
            }
        }
    }

    private function syncBilling(Request $request, $user)
    {

        $usermeta = $request->input('usermeta');

        if (empty($usermeta)) {
            return;
        }

        // Loop through all the meta keys we're looking for
        foreach ($usermeta as $key => $value) {

            $newMeta = new UserMeta(['key' => $key]);
            $meta = $user->meta()->where('key', $key)->first() ?: $newMeta->user()->associate($user);

            if (is_array($value)) {
                $value = serialize($value);
            }

            $meta->value = $value;
            $meta->save();

        }
    }

}
