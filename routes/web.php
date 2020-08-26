<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('clear', function() {
    Illuminate\Support\Facades\Artisan::call('config:clear');
    Illuminate\Support\Facades\Artisan::call('cache:clear');
    Illuminate\Support\Facades\Artisan::call('view:clear');

    echo 'Cache Cleared';
});

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->name('switch_lang');

Route::group(['namespace' => 'Frontend', 'middleware' => ['web']], function () {
    Route::get( '/page/{slug}', 'PageController@show' );

    Route::post( '/ipn/{gateway}', 'OrderController@ipn' )->name('ch_ipn');
});

Route::group(['namespace' => 'Frontend', 'middleware' => ['web', 'check_private_mode']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/category/{slug?}', 'HomeController@category')->name('category')->where('slug', '(.*)');
    Route::get( '/service/{slug}', 'ServiceController@show' )->name('ch_service_single');
    Route::post( '/service/pre_order_query', 'ServiceController@pre_order_query' )->name('ch_service_pre_order_query');
    Route::get('/service', 'HomeController@search')->name('search');

    Route::get( '/order/failed/{order_id}', 'OrderController@failed' )->name('ch_order_failed');
    Route::get( '/order/cancel/{order_id}', 'OrderController@cancel' )->name('ch_order_cancel');
    Route::get( '/order/thank-you/{order_id}', 'OrderController@completed' )->name('ch_order_submitted');
    Route::get( '/order/format_price', 'OrderController@formatPrice' )->name('ch_format_price');
    Route::any( '/order/update_tax', 'OrderController@update_tax' )->name('ch_update_tax');
    Route::post( '/order/update_cart', 'OrderController@update_cart' )->name('ch_update_cart');

    /**
     * Cart Routes
     */
    Route::get('/cart', 'CartController@show')->name('ch_cart');
    Route::post('/cart/store', 'CartController@store')->name('ch_cart_save');
    Route::post('/cart', 'CartController@update')->name('ch_cart_update');
});

Route::group(['namespace' => 'Frontend', 'middleware' => ['auth', 'verified']], function () {
    
    Route::post( '/order/submit', 'OrderController@submit' )->name('ch_order_save');
    Route::get('/order/pay/{order_id}', 'OrderController@showPaymentForm')->name('ch_pay_form');
    Route::post('/order/pay/{order_id}', 'OrderController@verifyPayment')->name('ch_verify_payment');

    Route::get('/account/orders', 'AccountController@orders')->name('ch_user_orders');
    Route::get('/account/notifications', 'AccountController@notifications')->name('ch_user_notifications');
    Route::get('/account/orders/{order_id}', 'AccountController@view_order')->name('ch_order_view');
    Route::put('/account/orders/{order_id}', 'AccountController@post_message');
    Route::get('/account/edit-details', 'AccountController@edit')->name('ch_edit_details');
    Route::put('/account/edit-details', 'AccountController@update')->name('ch_update_details');

    Route::post('cart/upload', 'CartController@upload')->name('upload_attachment');
    Route::get('attachment/{id}', 'HomeController@attachment')->name('download_attachment');
});


Route::post('ch-admin/ajax', 'Admin\AdminSettingController@ajax');


Auth::routes(['verify' => true]);
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social_login_callback');


Route::group(['prefix' => 'ch-admin', 'as'=>'ch-admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:administrator']], function () {
    Route::get('/', 'AdminDashboardController@index')->name('ch_admin_dashboard');
    Route::get('/notifications', 'AdminDashboardController@notifications')->name('ch_admin_notifications');
    Route::get('/updates', 'AdminUpdateController@index')->name('ch_admin_update');
    Route::post('/updates', 'AdminUpdateController@update')->name('ch_update_post');
    Route::get('/update/check_status', 'AdminUpdateController@update_status')->name('ch_check_status');
    Route::resource('category', 'AdminCategoryController');
    Route::resource('addon', 'AdminAddonController');
    Route::resource('form', 'AdminFormController');
    Route::resource('service', 'AdminServiceController');
    Route::resource('user', 'AdminUserController');
    Route::resource('settings', 'AdminSettingController');
    Route::resource('media', 'AdminMediaController');

    Route::resource('order', 'AdminOrderController');
    Route::get('order/{order_id}/messages', 'AdminOrderController@messages')->name('order.messages');

    Route::get('language/{lang_id}/phrases/{group?}', 'AdminLanguageController@phrases')->name('phrases.edit');
    Route::put('language/phrases/{lang_id}/{group}', 'AdminLanguageController@phrasesUpdate')->name('phrases.update');
    Route::resource('language', 'AdminLanguageController');

});