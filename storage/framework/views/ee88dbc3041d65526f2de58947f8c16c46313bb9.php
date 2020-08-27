<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        
        <div class="col-md-3 col-sm-3">
            <?php echo $__env->make('themes.default.account.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        
        <div class="col-md-9 col-sm-9">
            
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo app('translator')->get('order.orders'); ?></div>

                <div class="panel-body">
                    
                    
                    <div class="table-responsive">
                        <table class='table table-bordered'>
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('order.order_id'); ?></th>
                                <th><?php echo app('translator')->get('order.service_name'); ?></th>
                                <th><?php echo app('translator')->get('order.status'); ?></th>
                                <th><?php echo app('translator')->get('order.submitted'); ?></th>
                                <th><?php echo app('translator')->get('order.last_reply'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><a href="<?php echo e(route('ch_order_view', [$order->id])); ?>">#<?php echo e($order->id); ?></a></td>
                                    <td><?php echo e($order->service); ?></td>
                                    <td><?php echo e($order->status_text); ?></td>
                                    <td><?php echo e($order->created_at->diffForHumans()); ?></td>
                                    <?php if( $order->status != 'cancelled' ): ?>
                                        <td><a href="<?php echo e(route('ch_order_view', [$order->id])); ?>"><?php echo e(( count( $order->messages ) > 0 ) ? $order->messages->last()->user->username : trans('order.none_add_reply')); ?></a></td>
                                    <?php else: ?>
                                        <td><a href="<?php echo e(route('ch_order_view', [$order->id])); ?>"><?php echo app('translator')->get('order.view_details'); ?></a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>
                                    <td colspan="5" class="text-center"><strong><?php echo app('translator')->get('order.no_orders'); ?></strong></td>
                                </tr>

                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="text-center">
                        <?php echo e($orders->links()); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/account/orders.blade.php ENDPATH**/ ?>