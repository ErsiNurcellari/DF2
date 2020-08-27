<?php if(auth()->check()): ?>
    <ul class="nav navbar-nav navbar-right notification-dropdown">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">
            <span class="notification-bell"><i class="fa fa-bell"></i><?php if(auth()->user()->hasRole('customer') && \App\Models\User::find(auth()->user()->getAuthIdentifier())->unreadNotifications->count()): ?>
                    <b><?php echo e(\App\Models\User::find(auth()->user()->getAuthIdentifier())->unreadNotifications->count()); ?></b><?php endif; ?></span>
            </a>
            <ul class="dropdown-menu notify-drop">
                <div class="notify-drop-title">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6"><?php echo app('translator')->get('notifications.notifications'); ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="#" class="rIcon allRead"><?php echo app('translator')->get('notifications.mark_all_as_read'); ?></a></div>
                    </div>
                </div>
                <!-- end notify title -->
                <!-- notify content -->
                <div class="drop-content">
                    <?php if(auth()->user()->hasRole('customer')): ?>
                        <?php $__empty_1 = true; $__currentLoopData = auth()->user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="notify-img"><i class="fa fa-bell"></i></div>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">

                                    <?php if($notification->type == 'App\Notifications\Order\MessageAdded'): ?>
                                        <a href="<?php echo e(route('ch_order_view', [$notification->data['order_id']])); ?>"><?php echo app('translator')->get('notifications.new_message', ['order_id' => $notification->data['order_id']]); ?></a>
                                    <?php endif; ?>

                                    <?php if($notification->type == 'App\Notifications\Order\OrderCreated'): ?>
                                        <a href="<?php echo e(route('ch_order_view', [$notification->data['id']])); ?>"><?php echo app('translator')->get('notifications.order_submitted', ['order_id' => $notification->data['id']]); ?></a>
                                    <?php endif; ?>

                                    <?php if($notification->type == 'App\Notifications\Order\OrderUpdated'): ?>
                                        <?php if($notification->data['status'] == 'processing'): ?>
                                            <a href="<?php echo e(route('ch_order_view', [$notification->data['id']])); ?>"><?php echo app('translator')->get('notifications.order_being_processed', ['order_id' => $notification->data['id']]); ?></a>
                                        <?php endif; ?>

                                        <?php if($notification->data['status'] == 'completed'): ?>
                                            <a href="<?php echo e(route('ch_order_view', [$notification->data['id']])); ?>"><?php echo app('translator')->get('notifications.order_completed', ['order_id' => $notification->data['id']]); ?></a>
                                        <?php endif; ?>

                                        <?php if($notification->data['status'] == 'refunded'): ?>
                                            <a href="<?php echo e(route('ch_order_view', [$notification->data['id']])); ?>"><?php echo app('translator')->get('notifications.order_refunded', ['order_id' => $notification->data['id']]); ?></a>
                                        <?php endif; ?>

                                        <?php if($notification->data['status'] == 'cancelled'): ?>
                                            <a href="<?php echo e(route('ch_order_view', [$notification->data['id']])); ?>"><?php echo app('translator')->get('notifications.order_cancelled', ['order_id' => $notification->data['id']]); ?></a>
                                        <?php endif; ?>

                                        <?php if($notification->data['status'] == 'failed'): ?>
                                            <a href="<?php echo e(route('ch_order_view', [$notification->data['id']])); ?>"><?php echo app('translator')->get('notifications.order_failed', ['order_id' => $notification->data['id']]); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <hr>
                                    <p class="time" title="<?php echo e($notification->created_at); ?>"><?php echo e($notification->created_at->diffForHumans()); ?></p>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="notify-img"><i class="fa fa-info-circle"></i></div>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                    <?php echo app('translator')->get('notifications.no_notifications'); ?>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="notify-img"><i class="fa fa-info-circle"></i></div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                                <?php echo app('translator')->get('notifications.no_notifications'); ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </div>
                <div class="notify-drop-footer text-center">
                    <a href="#" class="clear-notifications"><i class="fa fa-close"></i> <?php echo app('translator')->get('notifications.clear_notifications'); ?></a>
                </div>
            </ul>
        </li>
    </ul>
<?php endif; ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/account/notifications_popup.blade.php ENDPATH**/ ?>