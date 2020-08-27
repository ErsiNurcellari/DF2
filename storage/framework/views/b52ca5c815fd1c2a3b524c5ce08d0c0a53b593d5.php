<?php $__env->startSection('content'); ?>

<div class="container" id="cart">
    <div class="row">

        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-danger"><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <form action="<?php echo e(route('ch_order_save')); ?>" method="post" id="payment-form">
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('POST')); ?>

            <div class="col-md-8">
                <div class="box-white order-page">

                    <h3 class="page-title"><?php echo app('translator')->get('cart.order_details'); ?></h3>

                    <div class="service-box clearfix">
                        <figure class="pull-left">
                            <a href="<?php echo e(route('ch_service_single', [$service->slug])); ?>">
                                <?php if($service->hasMedia('gallery')): ?>
                                    <img src="<?php echo e($service->firstMedia('gallery')->getUrl('medium')); ?>" class="img-responsive" alt="<?php echo e($service->title); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(get_placeholder_img()); ?>" class="img-responsive" alt="<?php echo e($service->title); ?>">
                                <?php endif; ?>
                            </a>
                        </figure>

                        <div class="service-content">
                            <h3><a href="<?php echo e(route('ch_service_single', [$service->slug])); ?>"><?php echo e($service->title); ?></a>
                            </h3>

                            <ul class="included">

                                <?php if( $service->hasMeta('delivery_time') || $service->hasMeta('revisions') ): ?>
                                    <li class="delivery"><i class="fa fa-undo"></i>
                                        <?php if($service->hasMeta('delivery_time')): ?>
                                            <?php echo e($service->getMeta('delivery_time')); ?>

                                        <?php endif; ?>
                                        <?php if($service->hasMeta('revisions')): ?>
                                            with <?php echo e($service->getMeta('revisions')); ?> Revisions
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>

                                <?php $__empty_1 = true; $__currentLoopData = $service->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li><i class="fa fa-check"></i> <?php echo e($task->name); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                        </div>
                    </div>


                    <h3><?php echo app('translator')->get('cart.addons'); ?></h3>
                    <?php $__empty_2 = true; $__currentLoopData = $service->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <div class="checkbox addon">
                        <label>
                            <span class="pull-right"><?php echo ch_format_price($addon->pivot->price); ?></span>
                            <input type="checkbox" name="addons[]" value="<?php echo e($addon->id); ?>" v-model="cartData.addons">
                                   <span class='addon-name'><?php echo e($addon->name); ?></span>
                        </label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                    <p><?php echo app('translator')->get('cart.no_addons'); ?></p>
                    <?php endif; ?>


                </div>

                <?php if(Auth::user()): ?>
            <?php if($service->form_id): ?>
                <div class="box-white">
                    <?php if( $service->hasMeta('guideline') ): ?>
                        <h3 class="box-heading"><?php echo app('translator')->get('cart.provide_info'); ?>:</h3>
                        <p><?php echo app('translator')->get('cart.provide_info_desc'); ?></p>
                        <?php echo nl2br( $service->getMeta('guideline') ); ?>

                    <?php endif; ?>
                        <br><br>
                        <?php echo $service->form->content ?? ''; ?>


                      <?php

                $__definedVars = (get_defined_vars()["__data"]);
                if (empty($__definedVars))
                {
                    $__definedVars = [];
                }
                $output = \Hook::get("template.ch_checkout_meta_fields",["data"=>$__definedVars],function($data) { return null; });
                if ($output)
                echo $output;
                ?>

                </div>
            <?php endif; ?>



                <div class="box-white order-billing">
                    <h3 class="box-heading"><?php echo app('translator')->get('account.profile.billing_info'); ?>:</h3>

                    <div class="row">
                        
                        <div class="form-group clearfix<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                            <label for="first_name" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.first_name'); ?></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" required class="form-control" name="first_name" value="<?php echo e(!empty(old('first_name')) ? old('first_name') : Auth::user()->first_name); ?>">

                                <?php if($errors->has('first_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group clearfix<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                            <label for="last_name" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.last_name'); ?></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" required class="form-control" name="last_name" value="<?php echo e(!empty(old('last_name')) ? old('last_name') : Auth::user()->last_name); ?>">

                                <?php if($errors->has('last_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        

                        <div class="form-group clearfix<?php echo e($errors->has('usermeta.billing_address') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_address]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.address'); ?></label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_address]" required type="text" class="form-control" name="usermeta[billing_address]" value="<?php echo e(!empty(old('usermeta.billing_address')) ? old('usermeta.billing_address') : Auth::user()->billing_address); ?>">

                                <?php if($errors->has('usermeta.billing_address')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('usermeta.billing_address')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group clearfix<?php echo e($errors->has('usermeta.billing_city') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_city]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.city'); ?></label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_city]" required type="text" class="form-control" name="usermeta[billing_city]" value="<?php echo e(!empty(old('usermeta.billing_city')) ? old('usermeta.billing_city') : Auth::user()->billing_city); ?>">

                                <?php if($errors->has('usermeta.billing_city')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('usermeta.billing_city')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group clearfix<?php echo e($errors->has('usermeta.billing_zip') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_zip]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.zip_code'); ?></label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_zip]" required type="text" class="form-control" name="usermeta[billing_zip]" value="<?php echo e(!empty(old('usermeta.billing_zip')) ? old('usermeta.billing_zip') : Auth::user()->billing_zip); ?>">

                                <?php if($errors->has('usermeta.billing_zip')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('usermeta.billing_zip')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group clearfix<?php echo e($errors->has('usermeta.billing_country') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_country]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.country'); ?></label>

                            <div class="col-md-6">
                                <select id="usermeta[billing_country]" required v-model="cartData.billing_country" type="text" class="form-control" name="usermeta[billing_country]" v-on:change="updateStates">
                                    <option value="0"><?php echo app('translator')->get('account.profile.select_country'); ?></option>
                                    <option v-for="country in countries" :value="country.id">{{country.name}}</option>
                                </select>

                                <?php if($errors->has('usermeta.billing_country')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('usermeta.billing_country')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group clearfix<?php echo e($errors->has('usermeta.billing_state') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_state]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.state'); ?></label>

                            <div class="col-md-6 user-state">
                                <div class='state-container'>
                                    <select id="usermeta[billing_state]" required v-model="cartData.billing_state" type="text" class="form-control" name="usermeta[billing_state]">

                                        <option value="0"><?php echo app('translator')->get('account.profile.select_state'); ?></option>
                                        <option v-for="state in states" :value="state.id">{{state.name}}</option>

                                    </select>
                                </div>


                                <?php if($errors->has('usermeta.billing_state')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('usermeta.billing_state')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            </div><!-- /.col-md-8 -->


            <div class="col-md-4">
                <div class="summary-container" data-sticky="true">
                    <?php echo $__env->make('core.order.summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </form>

    </div>


</div>
<script id="states-template" type="text/x-handlebars-template">
    <select id="usermeta[billing_state]" v-model="cartData.billing_state" class="form-control" name="usermeta[billing_state]">
        <option value=""><?php echo app('translator')->get('account.profile.select_state'); ?></option>
        {{#each this}}
            <option value="{{ @key  }}">{{this}}</option>
        {{/each}}    
    </select>
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('ch_footer'); ?>

    <?php
        $addon_ids = Cart::content()->filter(function($item){
            return $item->model instanceof \App\Models\Addon;
        })->pluck('id');

    ?>

    <script src="//js.stripe.com/v3/"></script>

    <script src="<?php echo e(asset('assets/backend/js/vendors/dropzone.min.js')); ?>"></script>
    <script>
        var upload_url = '<?php echo e(site_url('cart/upload')); ?>';
        var service_id = '<?php echo e($service->form_id); ?>';
        var countries = <?php echo $countries; ?>;
        var states = <?php echo $states; ?>;
        var addons = <?php echo $addon_ids; ?>;
        var billing_country = '<?php echo e($user_country); ?>';
        var billing_state = '<?php echo e($user_state); ?>';
        var cart_url = '<?php echo e(site_url('cart')); ?>';
    </script>
    <script src="<?php echo e(asset('assets/themes/default/js/vue.min.js')); ?>"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
    <script src="<?php echo e(asset('assets/themes/default/js/cart.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/cart.blade.php ENDPATH**/ ?>