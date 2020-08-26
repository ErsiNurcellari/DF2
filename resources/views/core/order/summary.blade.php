<div class="box-white">
    <div v-if="updating" class='overlay'></div>

    <div class="summary">
        <h3 class="box-heading">@lang('cart.order_summary.title')</h3>

        <div role="alert" class='alert alert-warning' style="display: none;"></div>

        @foreach( $cart->getCartItemsTransformed() as $row )
            <div class="row mb-12">
                <div class="col-md-6">{{$row->name}}</div>
                <div class="col-md-6 text-right">{!! ch_format_price($row->price) !!}</div>
            </div>
        @endforeach

        <div class="row mb-12">
            <div class="col-md-6">@lang('cart.order_summary.subtotal') </div>
            <div class="col-md-6 text-right"><span data-addon-total="0">{!! $cart->getSubtotalFormatted() !!}</span>
            </div>
        </div>

        @if ( setting('taxes.enabled', 'no') == 'yes' )

            <div class="row mb-12">
                <div class="col-md-6">@lang('cart.order_summary.tax')</div>
                <div class="col-md-6 text-right"><span data-addon-total="0">{!! $cart->getTaxFormatted() !!}</span>
                </div>
            </div>

        @endif

        <hr>

        <div class="row">
            <div class="col-md-6"><strong>@lang('cart.order_summary.total')</strong></div>
            <div class="col-md-6 text-right"><strong><span
                            data-summ-total="0">{!! $cart->getTotalFormatted() !!}</span></strong></div>

            <div class="col-md-12">
                <h3>@lang('cart.order_summary.total') <span
                            data-total="{!! $cart->getTotalFormatted()!!}">{!! $cart->getTotalFormatted() !!}</span> {{setting('currency', 'USD')}}
                </h3>
            </div>
        </div>
    </div>

    @if ($service->price > 0)

        <div class="form-group payment-methods">

            @if ( is_gateway_configured('paypal') )
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method" checked value="paypal">
                        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"
                             alt="paypal">
                    </label>
                </div>
            @endif

            @if ( is_gateway_configured('stripe') )
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method" value="stripe">@lang('cart.order_summary.credit_card_via_stripe')
                    </label>
                </div>
            @endif

                @if ( is_gateway_configured('razorpay') )
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_method" value="razorpay">@lang('RazorPay')
                        </label>
                    </div>
                @endif

            @if ( is_gateway_configured('offline_payments') )
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method"
                               value="offline_payments">{{setting('offline_payments.title')}}
                    </label>
                </div>
            @endif
        </div>

        @if ( is_gateway_configured('stripe') )
            <div class="form-row stripe" style="display: none;" data-method='stripe'>
                <label for="card-element">
                    @lang('cart.order_summary.credit_or_debit_card')
                </label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert" class='alert alert-warning' style="display: none;"></div>
            </div>
        @endif



        @if ( is_gateway_configured('razorpay') )
            <div class="form-row" style="display: none;" data-method='razorpay'>

            </div>
        @endif

        @if(is_gateway_configured('offline_payments'))
            <div class="form-row stripe" style="display: none;" data-method='offline_payments'>
                <p class="alert alert-info">{!! nl2br(setting('offline_payments.description')) !!}</p>
            </div>
        @endif

        @if ( is_gateway_configured('stripe') || is_gateway_configured('paypal') || is_gateway_configured('offline_payments') || is_gateway_configured('razorpay') )
            @if(  Auth::check() )
                <button id="submitForm" class="btn btn-primary btn-block btn-lg">@lang('cart.order_summary.place_order')</button>
            @else
                <p class="alert alert-warning">@lang('cart.order_summary.login_to_place_order', [
                'login_url' => route('login').'?to=/cart',
                'register_url' => route('register'),
                ])</p>
            @endif
        @else
            <p class="alert alert-warning"><i class="fa fa-info-circle"></i> @lang('cart.order_summary.payment_gateway_not_found')</p>
        @endif

    @else
        <button id="submitForm" class="btn btn-primary btn-block btn-lg">@lang('cart.order_summary.place_order')</button>
    @endif
</div>