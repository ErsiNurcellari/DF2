<?php $__env->startComponent('mail::message'); ?>
    <?php echo trim(preg_replace('/\h+/', ' ', trans('email.message_received.message', [
    'receiver' => $receiver,
    'sender' => $sender,
    'order_id' => $order_id,
    'url' => $url,
    'site_name' => setting('app.name', 'ChargePanda')
    ]))); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/emails/message_received.blade.php ENDPATH**/ ?>