<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

    <form class="form-horizontal" action="<?php echo e(route('ch-admin.order.update', $order->id)); ?>" method="post">
        <div class="row">


            <div class="col-md-8">
                <section class="invoice mb-20">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-cart-plus"></i> <a href="<?php echo e(route('ch-admin.order.show', [$order->id])); ?>">Order #<?php echo e($order->id); ?></a> Messages
                                <small class="pull-right">Date Time: <?php echo e($order->created_at); ?></small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                </section>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Attach files</h3>
                    </div>
                    <div class="boxy-body">

                        <div class="uploader"
                             data-media-config='{"key": "attachments", "container": ".order-files", "disk": "local"}'
                             data-files="<?php if(isset($order) && $order->hasMedia('attachments')): ?><?php echo e($attachments); ?><?php endif; ?>">
                            <?php echo $__env->make('admin.media.upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <div class="order-files"></div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Send message to Customer</h3>
                    </div>
                    <div class="box-body">

                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PUT')); ?>

                        <div class="<?php echo e($errors->has('content') ? ' has-error' : ''); ?>">

                            <?php if($errors->has('content')): ?>
                                <span class="help-block">
                            <strong><?php echo e($errors->first('content')); ?></strong>
                        </span>
                            <?php endif; ?>
                            <label for="content">Message</label>
                            <textarea name="content" class="form-control"><?php echo e(old('content')); ?></textarea>
                        </div>
                        <div class="" style="margin-top:20px;">
                            <input type="submit" name="post_message" value="Add Reply" class="btn btn-primary">
                        </div>

                    </div>
                </div>


                <?php $__empty_1 = true; $__currentLoopData = $order->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <div class="panel panel-default" id="message-<?php echo e($message->id); ?>">
                        <div class="panel-heading">
                            <span class="pull-right"><?php echo e($message->created_at->diffForHumans()); ?></span>
                            <a href="<?php echo e(site_url('ch-admin/user/'. $message->user->id . '/edit')); ?>"><?php echo e($message->user->name); ?></a>
                        </div>

                        <div class="panel-body"><?php echo e($message->content); ?></div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <?php endif; ?>

            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('ch_footer'); ?>
    <script src="<?php echo e(asset('assets/backend/js/vendors/dropzone.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/media.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/order/messages.blade.php ENDPATH**/ ?>