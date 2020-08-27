<?php $__env->startComponent('mail::message'); ?>
<?php if($status == 'processing'): ?>
<?php echo trim(preg_replace('/\h+/', ' ', trans('email.order_processing.message', [
'url' => $url,
'site_name' => setting('app.name', 'ChargePanda')
]))); ?>

<?php else: ?>
<?php echo trim(preg_replace('/\h+/', ' ', trans('email.order_completed.message', [
'url' => $url,
'site_name' => setting('app.name', 'ChargePanda')
]))); ?>

<?php endif; ?>
<?php echo $__env->renderComponent(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/emails/order/updated.blade.php ENDPATH**/ ?>