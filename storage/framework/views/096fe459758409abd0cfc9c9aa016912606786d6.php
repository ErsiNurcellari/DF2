<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row service-single">


            <div class="col-md-8 col-sm-7">
                <div class="service-box">
                    <h1 class="page-title"><?php echo e($service->title); ?></h1>

                    <?php if($service->hasMedia('gallery')): ?>

                        <?php if($service->getMedia('gallery')->count() > 1): ?>

                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">

                                    <?php $__currentLoopData = $service->getMedia('gallery'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="item <?php if($loop->first): ?> active <?php endif; ?>">
                                            <img src="<?php echo e($gallery->getUrl()); ?>" alt="">
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button"
                                   data-slide="prev">
                                    <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button"
                                   data-slide="next">
                                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        <?php else: ?>
                            <img src="<?php echo e($service->getMedia('gallery')->first()->getUrl()); ?>" class="img-responsive" alt="">
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if( $service->hasMeta('demo_url') && $service->getMeta('demo_url') != '' ): ?>
                        <p class="text-center demo-link"><a href="<?php echo e($service->getMeta('demo_url')); ?>" target="_blank"
                                                            class="btn btn-default"><?php echo app('translator')->get('service_detail.view_demo'); ?></a>
                        </p>
                    <?php endif; ?>


                    <div class="service-content">
                        <h3 class="sub-heading"><?php echo app('translator')->get('service_detail.description'); ?>:</h3>
                        <?php echo $service->description; ?>



                        <?php if( $service->hasMeta('guideline') ): ?>
                            <hr>
                            <h3><?php echo app('translator')->get('service_detail.guideline'); ?>:</h3>
                            <?php echo nl2br( $service->getMeta('guideline') ); ?>

                        <?php endif; ?>
                    </div>


                </div>
            </div>

            <div class="col-md-4 col-sm-5">
                <div class="order-box">
                    <div class="heading clearfix">
                        <span class="price"><?php echo $service->displayPrice; ?></span>
                        <h3><?php echo app('translator')->get('service_detail.order_detail'); ?></h3>
                    </div>

                    <ul class="included">

                        <?php if( $service->hasMeta('delivery_time') || $service->hasMeta('revisions') ): ?>
                            <li class="delivery"><i class="fa fa-undo"></i>
                                <?php if($service->hasMeta('delivery_time')): ?>
                                    <?php echo e($service->getMeta('delivery_time')); ?>

                                <?php endif; ?>
                                <?php if($service->hasMeta('revisions')): ?>
                                    <?php echo app('translator')->get('service_detail.with_revisions', ['rev' => $service->getMeta('revisions')]); ?>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <?php $__empty_1 = true; $__currentLoopData = $service->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li><i class="fa fa-check"></i> <?php echo e($task->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>


                    <form action="<?php echo e(route('ch_cart_save')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="item_id" value="<?php echo e($service->id); ?>">
                        <input type="submit" class="btn btn-primary btn-block" name="service_order"
                               value="<?php echo app('translator')->get('service_detail.order_now'); ?>">
                        <button type="button" class="btn btn-default btn-block" data-toggle="modal"
                                data-target="#preOrderModal"><?php echo app('translator')->get('service_detail.btn_contact_admin'); ?></button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div id="preOrderModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="<?php echo e(route('ch_service_pre_order_query')); ?>" method="post" id="pre-order-form">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo app('translator')->get('service_detail.pre_order_form_title'); ?></h4>
                    </div>
                    <input type="hidden" name="item_id" value="<?php echo e($service->id); ?>">
                    <div class="modal-body">
                        <?php if(auth()->guard()->guest()): ?>
                            <div class="form-group">
                                <label for="name"><?php echo app('translator')->get('service_detail.pre_order_form_name'); ?></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo app('translator')->get('service_detail.pre_order_form_email'); ?></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="message"><?php echo app('translator')->get('service_detail.pre_order_form_message'); ?></label>
                            <textarea name="message" id="message" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal"><?php echo app('translator')->get('service_detail.pre_order_btn_close'); ?></button>
                        <button type="submit"
                                class="btn btn-primary"><?php echo app('translator')->get('service_detail.pre_order_btn_submit'); ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/single.blade.php ENDPATH**/ ?>