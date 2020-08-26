<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="{{session('active_tab') == 'paypal' || is_null(session('active_tab')) ? 'active' : ''}}"><a href="#paypal" data-toggle="tab">PayPal</a></li>
        <li class="{{session('active_tab') == 'stripe' ? 'active' : ''}}"><a href="#stripe" data-toggle="tab">Stripe</a></li>
        <li class="{{session('active_tab') == 'razorpay' ? 'active' : ''}}"><a href="#razorpay" data-toggle="tab">RazorPay</a></li>
        <li class="{{session('active_tab') == 'offline-payments' ? 'active' : ''}}"><a href="#offline-payments" data-toggle="tab">Offline Payments</a></li>
    </ul>
    <div class="tab-content">
        <input type="hidden" id="active_tab" name="active_tab" value="{{session('active_tab') == 'paypal' || is_null(session('active_tab')) ? 'paypal' : session('active_tab')}}">
        <div class="tab-pane {{session('active_tab') == 'paypal' || is_null(session('active_tab')) ? 'active' : ''}}" id="paypal">


            <div class="form-group row">
                <label for="settings[paypal][enabled]" class="col-sm-2 control-label">Enable PayPal</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[paypal][enabled]" name="settings[paypal][enabled]">
                        <option value="yes" @if ( old('settings.paypal.enabled', setting('paypal.enabled')) == 'yes' ) SELECTED @endif>Yes</option>
                        <option value="no" @if ( old('settings.paypal.enabled', setting('paypal.enabled')) == 'no' ) SELECTED @endif>No</option>
                    </select>
                </div>
            </div>
            
            
            <div class="form-group row">
                <label for="settings[paypal][sandbox_mode]" class="col-sm-2 control-label">Enable Sandbox mode</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[paypal][sandbox_mode]" name="settings[paypal][sandbox_mode]">
                        <option value="yes" @if ( old('settings.paypal.sandbox_mode', setting('paypal.sandbox_mode')) == 'yes' ) SELECTED @endif>Yes</option>
                        <option value="no" @if ( old('settings.paypal.sandbox_mode', setting('paypal.sandbox_mode')) == 'no' ) SELECTED @endif>No</option>
                    </select>
                </div>
            </div>


            <h3 class="sub-settings">PayPal Live Account Settings</h3>


            <div class="form-group row">
                <label for="settings[paypal][live][username]" class="col-sm-2 control-label">PayPal API Username</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[paypal][live][username]" name="settings[paypal][live][username]" value="{{ old('settings.paypal.live.username', setting('paypal.live.username')) }}">
                </div>
            </div>


            <div class="form-group row">
                <label for="settings[paypal][live][password]" class="col-sm-2 control-label">PayPal API Password</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[paypal][live][password]" name="settings[paypal][live][password]" value="{{ old('settings.paypal.live.password', setting('paypal.live.password')) }}">
                </div>
            </div>


            <div class="form-group row">
                <label for="settings[paypal][live][signature]" class="col-sm-2 control-label">PayPal API Signature</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[paypal][live][signature]" name="settings[paypal][live][signature]" value="{{ old('settings.paypal.live.signature', setting('paypal.live.signature')) }}">
                </div>
            </div>


            <h3 class="sub-settings">PayPal Sandbox Account Settings</h3>


            <div class="form-group row">
                <label for="settings[paypal][sandbox][username]" class="col-sm-2 control-label">PayPal API Username</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[paypal][sandbox][username]" name="settings[paypal][sandbox][username]" value="{{ old('settings.paypal.sandbox.username', setting('paypal.sandbox.username')) }}">
                </div>
            </div>


            <div class="form-group row">
                <label for="settings[paypal][sandbox][password]" class="col-sm-2 control-label">PayPal API Password</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[paypal][sandbox][password]" name="settings[paypal][sandbox][password]" value="{{ old('settings.paypal.sandbox.password', setting('paypal.sandbox.password')) }}">
                </div>
            </div>


            <div class="form-group row">
                <label for="settings[paypal][sandbox][signature]" class="col-sm-2 control-label">PayPal API Signature</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[paypal][sandbox][signature]" name="settings[paypal][sandbox][signature]" value="{{ old('settings.paypal.sandbox.signature', setting('paypal.sandbox.signature')) }}">
                </div>
            </div>

        </div>

        <div class="tab-pane {{session('active_tab') == 'stripe' ? 'active' : ''}}" id="stripe">

            <div class="form-group row">
                <label for="settings[stripe][enabled]" class="col-sm-2 control-label">Enable Stripe</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[stripe][enabled]" name="settings[stripe][enabled]">
                        <option value="yes" @if ( old('settings.stripe.enabled', setting('stripe.enabled')) == 'yes' ) SELECTED @endif>Yes</option>
                        <option value="no" @if ( old('settings.stripe.enabled', setting('stripe.enabled')) == 'no' ) SELECTED @endif>No</option>
                    </select>
                </div>
            </div>
            
            
            <div class="form-group row">
                <label for="settings[stripe][sandbox_mode]" class="col-sm-2 control-label">Enable Test mode</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[stripe][sandbox_mode]" name="settings[stripe][sandbox_mode]">
                        <option value="yes" @if ( old('settings.stripe.sandbox_mode', setting('stripe.sandbox_mode')) == 'yes' ) SELECTED @endif>Yes</option>
                        <option value="no" @if ( old('settings.stripe.sandbox_mode', setting('stripe.sandbox_mode')) == 'no' ) SELECTED @endif>No</option>
                    </select>
                </div>
            </div>


            <h3 class="sub-settings">Stripe Live Account Settings</h3>


            <div class="form-group row">
                <label for="settings[stripe][live][pk]" class="col-sm-2 control-label">Stripe Publishable key</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[stripe][live][pk]" name="settings[stripe][live][pk]" value="{{ old('settings.stripe.live.pk', setting('stripe.live.pk')) }}">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="settings[stripe][live][sk]" class="col-sm-2 control-label">Stripe Secret key</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[stripe][live][sk]" name="settings[stripe][live][sk]" value="{{ old('settings.stripe.live.sk', setting('stripe.live.sk')) }}">
                </div>
            </div>

            <h3 class="sub-settings">Stripe Sandbox Account Settings</h3>


            <div class="form-group row">
                <label for="settings[stripe][sandbox][pk]" class="col-sm-2 control-label">Stripe Publishable key</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[stripe][sandbox][pk]" name="settings[stripe][sandbox][pk]" value="{{ old('settings.stripe.sandbox.pk', setting('stripe.sandbox.pk')) }}">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="settings[stripe][sandbox][sk]" class="col-sm-2 control-label">Stripe Secret key</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[stripe][sandbox][sk]" name="settings[stripe][sandbox][sk]" value="{{ old('settings.stripe.sandbox.sk', setting('stripe.sandbox.sk')) }}">
                </div>
            </div>

        </div>

        <div class="tab-pane {{session('active_tab') == 'razorpay' ? 'active' : ''}}" id="razorpay">

            <div class="form-group row">
                <label for="settings[razorpay][enabled]" class="col-sm-2 control-label">Enable RazorPay</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[razorpay][enabled]" name="settings[razorpay][enabled]">
                        <option value="no" @if ( old('settings.razorpay.enabled', setting('razorpay.enabled')) == 'no' ) SELECTED @endif>No</option>
                        <option value="yes" @if ( old('settings.razorpay.enabled', setting('razorpay.enabled')) == 'yes' ) SELECTED @endif>Yes</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="settings[razorpay][sandbox_mode]" class="col-sm-2 control-label">Enable Test mode</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[razorpay][sandbox_mode]" name="settings[razorpay][sandbox_mode]">
                        <option value="no" @if ( old('settings.razorpay.sandbox_mode', setting('razorpay.sandbox_mode')) == 'no' ) SELECTED @endif>No</option>
                        <option value="yes" @if ( old('settings.razorpay.sandbox_mode', setting('razorpay.sandbox_mode')) == 'yes' ) SELECTED @endif>Yes</option>
                    </select>
                </div>
            </div>


            <h3 class="sub-settings">RazorPay Live Account Settings</h3>


            <div class="form-group row">
                <label for="settings[razorpay][live][ki]" class="col-sm-2 control-label">RazorPay Key ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[razorpay][live][ki]" name="settings[razorpay][live][ki]" value="{{ old('settings.razorpay.live.ki', setting('razorpay.live.ki')) }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="settings[razorpay][live][sk]" class="col-sm-2 control-label">RazorPay Secret key</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[razorpay][live][sk]" name="settings[razorpay][live][sk]" value="{{ old('settings.razorpay.live.sk', setting('razorpay.live.sk')) }}">
                </div>
            </div>

            <h3 class="sub-settings">RazorPay Sandbox Account Settings</h3>


            <div class="form-group row">
                <label for="settings[razorpay][sandbox][ki]" class="col-sm-2 control-label">RazorPay Key ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[razorpay][sandbox][ki]" name="settings[razorpay][sandbox][ki]" value="{{ old('settings.razorpay.sandbox.ki', setting('razorpay.sandbox.ki')) }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="settings[razorpay][sandbox][sk]" class="col-sm-2 control-label">RazorPay Secret key</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[razorpay][sandbox][sk]" name="settings[razorpay][sandbox][sk]" value="{{ old('settings.razorpay.sandbox.sk', setting('razorpay.sandbox.sk')) }}">
                </div>
            </div>

        </div>

        <div class="tab-pane {{session('active_tab') == 'offline-payments' ? 'active' : ''}}" id="offline-payments">

            <div class="form-group row">
                <label for="settings[offline_payments][enabled]" class="col-sm-2 control-label">Enable Offline
                    Payments</label>
                <div class="col-sm-3">
                    <select class="form-control" id="settings[offline_payments][enabled]"
                            name="settings[offline_payments][enabled]">
                        <option value="no"
                                @if ( old('settings.offline_payments.enabled', setting('offline_payments.enabled')) == 'no' ) SELECTED @endif>
                            No
                        </option>
                        <option value="yes"
                                @if ( old('settings.offline_payments.enabled', setting('offline_payments.enabled')) == 'yes' ) SELECTED @endif>
                            Yes
                        </option>
                    </select>
                </div>
            </div>

            <h3 class="sub-settings">Offline Account Settings</h3>

            <div class="form-group row">
                <label for="settings[offline_payments][title]" class="col-sm-2 control-label">Payment Method
                    Title</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="settings[offline_payments][title]"
                           name="settings[offline_payments][title]"
                           value="{{ old('settings.offline_payments.title', setting('offline_payments.title')) }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="settings[offline_payments][description]" class="col-sm-2 control-label">Payment Method
                    Description</label>
                <div class="col-sm-4">
                    <textarea name="settings[offline_payments][description]"
                              id="settings[offline_payments][description]"
                              class="form-control">{{ old('settings.offline_payments.description', setting('offline_payments.description')) }}</textarea>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>

@push('ch_footer')
    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            let target = $(e.target).attr("href"); // activated tab
            let activeSection = target.replace('#', '');

            $('#active_tab').val(activeSection);
        });
    </script>
@endpush