<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-3">
                <?php echo $__env->make('themes.default.account.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-md-9 col-sm-9">
                <h1>Order#<?php echo e($order->id); ?></h1>

                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo app('translator')->get('order.order_details'); ?></div>
                    <div class="panel-body">

                        <div class="row"
                             style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;">
                            <div class="col-md-2 col-sm-3"><strong><?php echo app('translator')->get('order.status'); ?></strong></div>
                            <div class="col-md-4 col-sm-3"><?php echo e($order->status_text); ?></div>
                            <div class="col-md-2 col-sm-3"><strong><?php echo app('translator')->get('order.submitted'); ?></strong></div>
                            <div class="col-md-4 col-sm-3"><?php echo e($order->created_at->diffForHumans()); ?></div>
                        </div>

                        <div class="row" style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;">

                            <div class="col-md-2 col-sm-3"><strong><?php echo app('translator')->get('order.service_name'); ?></strong></div>
                            <div class="col-md-4 col-sm-3"><?php echo e($order->items->first()->name()); ?></div>
                            <div class="col-md-2 col-sm-3"><strong><?php echo app('translator')->get('order.addons'); ?></strong></div>
                            <div class="col-md-4 col-sm-3">
                                <?php if( $order->items->where('item_type', 'addon')->count() > 0 ): ?>
                                    <?php $__currentLoopData = $order->items->where('item_type', 'addon'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($addon->name()); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <?php if( $order->addons && count($order->addons) > 0): ?>
                                    <?php $__currentLoopData = $order->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($addon['name'] or ""); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-3"><strong></strong></div>
                            <div class="col-md-4 col-sm-3"></div>
                            <div class="col-md-2 col-sm-3"><strong><?php echo app('translator')->get('order.total'); ?></strong></div>
                            <div class="col-md-4 col-sm-3"><?php echo $order->TotalFormatted(); ?></div>
                        </div>

                        <?php if($order->hasMedia('downloads') && ($order->status != 'cancelled' || $order->status != 'refunded')): ?>
                            <div class="row" style="border-top: 1px solid #EEE; padding-top: 12px; margin-top: 12px;">
                                <div class="col-md-3 col-sm-3"><strong><?php echo app('translator')->get('order.downloads'); ?></strong></div>
                                <div class="col-md-9 col-sm-9">
                                    <?php $__currentLoopData = $order->getMedia('downloads'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        - <a href="<?php echo e(route('download_attachment', $media->token)); ?>"><strong><?php echo e($media->Basename); ?></strong></a>
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <?php if($order->hasMedia('attachments')): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo app('translator')->get('order.attachments.attachments'); ?></div>
                        <div class="panel-body">
                            <?php $__currentLoopData = $order->getMedia('attachments'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!isset($media->token)): ?>
                                    <?php continue; ?>;
                                <?php endif; ?>
                                <div class="row" <?php if(!$loop->last): ?> style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;"<?php endif; ?>>
                                    <div class="col-md-12"><a href="<?php echo e(route('download_attachment', $media->token)); ?>"><strong><?php echo e($media->Basename); ?></strong></a> (<?php echo app('translator')->get('order.attachments.submitted'); ?> <?php echo e($media->created_at->diffForHumans()); ?>)</div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($order->customFields->count()): ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo app('translator')->get('order.submitted_info'); ?></div>
                    <div class="panel-body">
                        <?php $__currentLoopData = $order->customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->type == 'file' && !isset($row->file->token)): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <div class="row"
                                 <?php if(!$loop->last): ?>
                                 style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;"
                                 <?php endif; ?>
                            >
                                <div class="col-md-4 col-sm-4"><strong><?php echo e($row->label); ?></strong></div>
                                <div class="col-md-8 col-sm-8"><?php echo $row->type == 'file' ? '<a href="'.route('download_attachment', $row->file->token).'">'.$row->file->filename.'</a>' : $row->value; ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                 <?php

                $__definedVars = (get_defined_vars()["__data"]);
                if (empty($__definedVars))
                {
                    $__definedVars = [];
                }
                $output = \Hook::get("template.ch_view_order_after_details",["data"=>$__definedVars],function($data) { return null; });
                if ($output)
                echo $output;
                ?>

                <?php if($order->status != 'cancelled'): ?>
                    <?php if($order->status != 'completed'): ?>
                        <form action="" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>

                            <div class="form-group<?php echo e($errors->has('content') ? ' has-error' : ''); ?>">

                                <?php if($errors->has('content')): ?>
                                    <span class="help-block">
                                <strong><?php echo e($errors->first('content')); ?></strong>
                            </span>
                                <?php endif; ?>
                                <label for="content"><?php echo app('translator')->get('order.message'); ?></label>
                                <textarea name="content" class="form-control"><?php echo e(old('content')); ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="post_message" value="<?php echo app('translator')->get('order.add_reply'); ?>" class="btn btn-primary">
                            </div>
                        </form>

                        <?php $__empty_1 = true; $__currentLoopData = $order->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <div class="panel panel-default" id="message-<?php echo e($message->id); ?>">
                                <div class="panel-heading">
                                    <span class="pull-right"><?php echo e($message->created_at->diffForHumans()); ?></span>
                                    <?php echo e($message->user->username); ?>

                                </div>

                                <div class="panel-body"><?php echo e($message->content); ?></div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <?php endif; ?>

                    <?php else: ?>

                        <?php if( $order->feedback(\Auth::user()->id) ): ?>

                            <h3><?php echo app('translator')->get('order.your_feedback'); ?>:</h3>

                            <div class="form-group">
                                <p><strong><?php echo app('translator')->get('order.your_rating'); ?></strong></p>
                                <select class="posted" id="rating">
                                    <?php for( $x = 1; $x <= 5; $x++ ): ?>
                                        <option value="<?php echo e($x); ?> "<?php echo e($order->feedback(\Auth::user()->id)->rating == $x ? 'SELECTED' : ''); ?>><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <p><strong><?php echo app('translator')->get('order.your_comments'); ?>:</strong></p>
                            <p><?php echo e($order->feedback(\Auth::user()->id)->content); ?></p>


                        <?php else: ?>
                            <h3><?php echo app('translator')->get('order.provide_feedback'); ?></h3>

                            <form action="" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('PUT')); ?>


                                <div class="form-group">
                                    <label for="rating"><?php echo app('translator')->get('order.your_rating'); ?></label>
                                    <select id="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group<?php echo e($errors->has('content') ? ' has-error' : ''); ?>">

                                    <?php if($errors->has('content')): ?>
                                        <span class="help-block">
                                <strong><?php echo e($errors->first('content')); ?></strong>
                            </span>
                                    <?php endif; ?>
                                    <label for="content"><?php echo app('translator')->get('order.comments'); ?></label>
                                    <textarea name="content" class="form-control"><?php echo e(old('content')); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="post_feedback" value="<?php echo app('translator')->get('order.submit_feedback'); ?>"
                                           class="btn btn-primary">
                                </div>
                            </form>
                        <?php endif; ?>



                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/account/order_view.blade.php ENDPATH**/ ?>