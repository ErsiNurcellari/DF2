<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

    <form class="form-horizontal" action="<?php echo e(route('ch-admin.order.update', $order->id)); ?>" method="post">
        <div class="row">

            <?php echo e(method_field('PUT')); ?>

            <?php echo e(csrf_field()); ?>

            <div class="col-md-8">
                <section class="invoice mb-20">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-cart-plus"></i> Order #<?php echo e($order->id); ?> details - <a href="<?php echo e(route('ch-admin.order.messages', [$order->id])); ?>">Messages</a>
                                <small class="pull-right">Date Time: <?php echo e($order->created_at); ?></small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead">General:</p>
                            <strong>Submitted: </strong><span
                                    title="<?php echo e($order->created_at); ?>"><?php echo e($order->created_at->diffForHumans()); ?></span><br>
                            <strong>Order
                                Status: </strong><?php echo e($order->status == 'pending' ? 'Pending Payment' : ucfirst($order->status)); ?>

                            <br><br>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <p class="lead">Billing Details:</p>
                            <address>
                                <strong>Name:</strong> <a
                                        href="<?php echo e(route('ch-admin.user.edit', [$order->user->id])); ?>"><?php echo e($order->getMeta('billing_first_name') . ' ' . $order->getMeta('billing_last_name')); ?></a><br>
                                <strong>Address:</strong> <?php echo $order->getMeta('billing_address') ?? 'N/A'; ?><br>
                                <strong>City:</strong> <?php echo $order->getMeta('billing_city') ?? 'N/A'; ?><br>
                                <strong>State:</strong> <?php echo $order->state->name ?? 'N/A'; ?><br>
                                <strong>Country:</strong> <?php echo $order->country->name ?? 'N/A'; ?><br>
                                <strong>Zip code:</strong> <?php echo $order->getMeta('billing_zip') ?? 'N/A'; ?><br>
                            </address>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <p class="lead mt-30">Item Purchased:</p>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <!-- where('key', '_item_name')->first()->value -->
                                    <tr>
                                        <td><?php echo e($item->name()); ?></td>
                                        <td><?php echo e($item->qty()); ?></td>
                                        <td><?php echo ch_format_price( $item->subtotal(), $order->currency() ); ?></td>
                                        <td><?php echo ch_format_price( $item->total(), $order->currency() ); ?></td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if( $order->addons && count($order->addons) > 0): ?>
                                    <?php $__currentLoopData = $order->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($addon['name'] or ""); ?></td>
                                            <td>1</td>
                                            <td><?php echo ch_format_price( $addon['price'], $order->currency() ); ?></td>
                                            <td><?php echo ch_format_price( $addon['price'], $order->currency() ); ?></td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">

                            <p class="lead">Payment Details:</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="w-50p">Payment method:</th>
                                        <td><?php echo e(ucfirst(str_replace('_', ' ', $order->PaymentMethod()))); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <td><?php echo e($order->transactionId()); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Summary</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="w-50p">Subtotal:</th>
                                        <td><?php echo $order->subtotal(); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <td><?php echo $order->taxTotal(); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td><?php echo $order->totalFormatted(); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
            </div>

            <div class="col-md-4">
                <?php if($order->customFields->count()): ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Customer Provided Info</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <?php $__currentLoopData = $order->customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($row->label); ?></th>
                                        <td><?php echo $row->type == 'file' ? '<a href="'.route('download_attachment', $row->file->token).'">'.$row->file->filename.'</a>' : $row->value; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Update Order</h3>

                        <div class="box-tools">

                        </div>
                    </div>

                    <?php if($order->PaymentMethod() == 'offline_payments'): ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="transaction_id" class="col-sm-12">Transaction Id</label>
                                <div class="col-sm-12">
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                                           value="<?php echo e($order->transactionId()); ?>"/>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="status" class="col-sm-12">Order Status</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="status">
                                    <option value="pending" <?php echo e($order->status == 'pending' ? 'SELECTED' : ''); ?>>Pending
                                        Payment
                                    </option>
                                    <option value="processing" <?php echo e($order->status == 'processing' ? 'SELECTED' : ''); ?>>
                                        Processing
                                    </option>
                                    <option value="completed" <?php echo e($order->status == 'completed' ? 'SELECTED' : ''); ?>>
                                        Completed
                                    </option>
                                    <option value="refunded" <?php echo e($order->status == 'refunded' ? 'SELECTED' : ''); ?>>
                                        Refunded
                                    </option>
                                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'SELECTED' : ''); ?>>
                                        Cancelled
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer clearfix">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <input type="submit" name="update_order" value="Update Order"
                                       class="btn btn-primary pull-right">
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/order/show.blade.php ENDPATH**/ ?>