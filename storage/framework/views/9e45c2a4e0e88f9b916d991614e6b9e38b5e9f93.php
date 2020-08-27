<div class="box-white">
    <div v-if="updating" class='overlay'></div>

    <div class="summary">
        <h3 class="box-heading"><?php echo app('translator')->get('cart.order_summary.title'); ?></h3>

        <div role="alert" class='alert alert-warning' style="display: none;"></div>

        <?php $__currentLoopData = $cart->getCartItemsTransformed(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row mb-12">
                <div class="col-md-6"><?php echo e($row->name); ?></div>
                <div class="col-md-6 text-right"><?php echo ch_format_price($row->price); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row mb-12">
            <div class="col-md-6"><?php echo app('translator')->get('cart.order_summary.subtotal'); ?> </div>
            <div class="col-md-6 text-right"><span data-addon-total="0"><?php echo $cart->getSubtotalFormatted(); ?></span>
            </div>
        </div>

        <?php if( setting('taxes.enabled', 'no') == 'yes' ): ?>

            <div class="row mb-12">
                <div class="col-md-6"><?php echo app('translator')->get('cart.order_summary.tax'); ?></div>
                <div class="col-md-6 text-right"><span data-addon-total="0"><?php echo $cart->getTaxFormatted(); ?></span>
                </div>
            </div>

        <?php endif; ?>

        <hr>

        <div class="row">
            <div class="col-md-6"><strong><?php echo app('translator')->get('cart.order_summary.total'); ?></strong></div>
            <div class="col-md-6 text-right"><strong><span
                            data-summ-total="0"><?php echo $cart->getTotalFormatted(); ?></span></strong></div>

            <div class="col-md-12">
                <h3><?php echo app('translator')->get('cart.order_summary.total'); ?> <span
                            data-total="<?php echo $cart->getTotalFormatted(); ?>"><?php echo $cart->getTotalFormatted(); ?></span> <?php echo e(setting('currency', 'USD')); ?>

                </h3>
            </div>
        </div>
    </div>

    <?php if($service->price > 0): ?>

        <div class="form-group payment-methods">

            <?php if( is_gateway_configured('paypal') ): ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method" checked value="paypal">
                        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"
                             alt="paypal">
                    </label>
                </div>
            <?php endif; ?>

            <?php if( is_gateway_configured('stripe') ): ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method" value="stripe"><?php echo app('translator')->get('cart.order_summary.credit_card_via_stripe'); ?>
                    </label>
                </div>
            <?php endif; ?>

                <?php if( is_gateway_configured('razorpay') ): ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_method" value="razorpay"><?php echo app('translator')->get('RazorPay'); ?>
                        </label>
                    </div>
                <?php endif; ?>

            <?php if( is_gateway_configured('offline_payments') ): ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method"
                               value="offline_payments"><?php echo e(setting('offline_payments.title')); ?>

                    </label>
                </div>
            <?php endif; ?>
        </div>

        <?php if( is_gateway_configured('stripe') ): ?>
            <div class="form-row stripe" style="display: none;" data-method='stripe'>
                <label for="card-element">
                    <?php echo app('translator')->get('cart.order_summary.credit_or_debit_card'); ?>
                </label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert" class='alert alert-warning' style="display: none;"></div>
            </div>
        <?php endif; ?>



        <?php if( is_gateway_configured('razorpay') ): ?>
            <div class="form-row" style="display: none;" data-method='razorpay'>

            </div>
        <?php endif; ?>

        <?php if(is_gateway_configured('offline_payments')): ?>
            <div class="form-row stripe" style="display: none;" data-method='offline_payments'>
                <p class="alert alert-info"><?php echo nl2br(setting('offline_payments.description')); ?></p>
            </div>
        <?php endif; ?>

        <?php if( is_gateway_configured('stripe') || is_gateway_configured('paypal') || is_gateway_configured('offline_payments') || is_gateway_configured('razorpay') ): ?>
            <?php if(  Auth::check() ): ?>
                <button id="submitForm" class="btn btn-primary btn-block btn-lg"><?php echo app('translator')->get('cart.order_summary.place_order'); ?></button>
            <?php else: ?>
                <p class="alert alert-warning"><?php echo app('translator')->get('cart.order_summary.login_to_place_order', [
                'login_url' => route('login').'?to=/cart',
                'register_url' => route('register'),
                ]); ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p class="alert alert-warning"><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('cart.order_summary.payment_gateway_not_found'); ?></p>
        <?php endif; ?>

    <?php else: ?>
        <button id="submitForm" class="btn btn-primary btn-block btn-lg"><?php echo app('translator')->get('cart.order_summary.place_order'); ?></button>
    <?php endif; ?>
</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/core/order/summary.blade.php ENDPATH**/ ?>