<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Role;
use App\Notifications\Order\MessageAdded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ValidatePassword;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use App\Models\Country;
use App\Models\State;
use App\Services\UserService;
use Hash;
use Swift_TransportException;

class AccountController extends Controller
{
    
    private $userService;
    
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    public function edit() {
        $user = \Auth::user();
        $countries = Country::all()->pluck( 'name', 'id');
        $states = collect([]);
        
        if (isset($user->billing_country)) {
            $states = $user->billing_country->states->pluck('name', 'id') ?? collect([]);
        }
        
        if (old('usermeta.billing_country')) {
            $states = State::where('country_id', old('usermeta.billing_country'))->pluck('name', 'id');
        }

        $title = trans('account.profile.edit_account');
        
        return view('themes.default.account.edit', compact('user', 'countries', 'states', 'title'));
    }
    
    
    public function orders() {
        $orders = \Auth::user()->orders()->orderBy('id', 'DESC')->paginate(15);
        $title = trans('order.orders');
        return view('themes.default.account.orders', compact('orders', 'title'));
    }

    
    public function view_order( Request $request, $order_id ) {
        $order = \Auth::user()->orders()->findOrFail( $order_id );
        $title = trans('order.order_details');
        return view('themes.default.account.order_view', compact('order', 'title'));
    }
    
    
    public function post_message( Request $request, $order_id ) {
        
        $order = \Auth::user()->orders()->findOrFail( $order_id );

        if ( $request->input('post_message') ) {
            $request->validate([
                'content' => 'string|required'
            ]);
        }

        $order->messages()->create([
            'content' => $request->input('content'),
            'type' => $request->input('post_message') ? 'message' : 'feedback',
            'user_id' => \Auth::user()->id,
            'rating' => $request->input('rating') ? $request->input('rating') : 5
        ]);

        if ( $request->input('post_message') ) {

            $usersWithAdminRole = Role::where('name', 'administrator')->first()->users()->get();

            try {
                \Notification::send($usersWithAdminRole, new MessageAdded($order, \Auth::user(), route('ch-admin.order.show', $order->id)));
            } catch (Swift_TransportException $exception) { }

            Flash::success(trans('order.message_sent'));

        } else {

            Flash::success(trans('order.feedback_submitted'));

        }



        return redirect()->route('ch_order_view', [$order->id]);
    }
    

    public function update( Request $request ) {
        
        $input = $request->all();
        
        $rules['first_name'] = 'string|max:255';
        $rules['last_name'] = 'string|max:255';
        $rules['email'] = 'required|string|email|max:255|unique:users,email,'.\Auth::user()->id;
        
        if ( isset( $input['current_password'] ) ) {
            $rules['current_password'] = [new ValidatePassword(auth()->user())];
            $rules['new_password'] = 'required|string|min:6';
            $input['password'] = Hash::make($input['new_password']);
        }
        
        $request->validate($rules);
        
        try {
            $this->userService->update($input, auth()->user()->id);
        } catch (\Exception $ex) {
            dd($ex);
            return redirect()->back()
                    ->withInput()
                    ->withErrors(trans('account.profile.profile_error'));
        }
        
        Flash::success(trans('account.profile.profile_updated'));

        return redirect()->route('ch_edit_details'); 
    }


    public function notifications(Request $request)
    {
        if ($request->ajax()) {

            if($request->has('mark_all_as_read')) {
                auth()->user()->unreadNotifications->markAsRead();
            }

            if ($request->has('delete_notifications')) {
                auth()->user()->notifications()->delete();
            }

            $view = (string)View::make('themes.default.account.notifications_popup');
            return response()->json(['success' => true, 'html' => $view]);
        }
    }
}
