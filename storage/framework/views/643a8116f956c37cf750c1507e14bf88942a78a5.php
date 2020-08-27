<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row text-center">
            <div class="col-md-8 col-md-offset-2">
                <div style="padding: 180px 0">
                    <h1><?php echo app('translator')->get('order.thank_you.heading'); ?></h1>
                    <p class="lead"><?php echo app('translator')->get('order.thank_you.thank_lead'); ?></p>
                    <p><a class="btn btn-primary" href="<?php echo e(route('ch_order_view', $order->id)); ?>"><?php echo app('translator')->get('order.thank_you.view_order'); ?></a></p>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/thankyou.blade.php ENDPATH**/ ?>