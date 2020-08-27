<li class="dropdown notifications-menu notification-dropdown">
    <a href="#" class="dropdown-toggle mark-as-read" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <?php if(\App\Models\User::find(auth()->user()->getAuthIdentifier())->unreadNotifications->count()): ?>
            <span class="label label-danger"><?php echo e(\App\Models\User::find(auth()->user()->getAuthIdentifier())->unreadNotifications->count()); ?></span>
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu">
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <?php $__empty_1 = true; $__currentLoopData = auth()->user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li>
                    <?php if($notification->type == 'App\Notifications\Order\OrderCreated'): ?>
                        <a href="<?php echo e(route('ch-admin.order.show', [$notification->data['id']])); ?>">
                            <i class="fa fa-shopping-cart text-aqua"></i> You have a new Order (#<?php echo e($notification->data['id']); ?>)
                        </a>
                    <?php endif; ?>

                        <?php if($notification->type == 'App\Notifications\Order\MessageAdded'): ?>
                            <a href="<?php echo e(route('ch-admin.order.messages', [$notification->data['order_id']])); ?>">
                                <i class="fa fa-envelope text-aqua"></i> You have new message in Order#<?php echo e($notification->data['order_id']); ?>

                            </a>
                        <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-search text-aqua"></i> No new notifications.
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
        <li class="footer"><a href="#" class="clear-notifications">Clear Notifications</a></li>
    </ul>
</li><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/layouts/notifications_popup.blade.php ENDPATH**/ ?>