


<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo e($title); ?></h3>

                <form action="">

                </form>
                <div class="box-tools">
                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input name="s" class="form-control pull-right" placeholder="Search" type="text" value="<?php echo e(Request::input('s')); ?>">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body table-responsive no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if( ! empty( $orders ) ): ?>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">
                                <a href="<?php echo e(route('ch-admin.order.show', [$order->id])); ?>">#<?php echo e($order->id); ?></a> - <a href="<?php echo e(route('ch-admin.order.messages', [$order->id])); ?>">Messages</a>
                            </th>
                            <td><?php echo e($order->status); ?></td>
                            <td><?php echo e($order->created_at->diffForHumans() ?? $order->created_at); ?></td>
                            <td><?php echo $order->totalFormatted(); ?></td>
                            <td>
                                <form method="post" action="<?php echo e(route('ch-admin.order.destroy', $order->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                    <tr>
                        <td colspan="4">No Orders found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">
                <?php echo e($orders->links()); ?>

            </div>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/order/index.blade.php ENDPATH**/ ?>