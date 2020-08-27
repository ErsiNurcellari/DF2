

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        
        <div class="col-md-3">
            <?php echo $__env->make('themes.default.account.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo app('translator')->get('account.profile.edit_account'); ?></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('ch_update_details')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PUT')); ?>


                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.username'); ?></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo e($user->username); ?>" readonly>

                                <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                            <label for="first_name" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.first_name'); ?></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="<?php echo e(!empty(old('first_name')) ? old('first_name') : $user->first_name); ?>" required autofocus>

                                <?php if($errors->has('first_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                            <label for="last_name" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.last_name'); ?></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="<?php echo e(!empty(old('last_name')) ? old('last_name') : $user->last_name); ?>" required autofocus>

                                <?php if($errors->has('last_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.email_address'); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
                            <label for="current_password" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.current_password'); ?></label>

                            <div class="col-md-6">
                                <input id="current_password" type="current_password" class="form-control" name="current_password">
                                <small class="help-block"><?php echo app('translator')->get('account.profile.change_pass_note'); ?></small>
                                <?php if($errors->has('current_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('current_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="form-group<?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
                            <label for="new_password" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.new_password'); ?></label>

                            <div class="col-md-6">
                                <input id="new_password" type="new_password" class="form-control" name="new_password">
                                <small class="help-block"><?php echo app('translator')->get('account.profile.new_pass_note'); ?></small>
                                <?php if($errors->has('new_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('new_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <h4><?php echo app('translator')->get('account.profile.billing_info'); ?></h4>
                        <hr>
                        
                        <div class="form-group<?php echo e($errors->has('usermeta.billing_address') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_address]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.address'); ?></label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_address]" type="text" class="form-control" name="usermeta[billing_address]" value="<?php echo e(!empty(old('usermeta.billing_address')) ? old('usermeta.billing_address') : $user->billing_address); ?>">

                                <?php if($errors->has('usermeta.billing_address')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('usermeta.billing_address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group<?php echo e($errors->has('usermeta.billing_city') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_city]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.city'); ?></label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_city]" type="text" class="form-control" name="usermeta[billing_city]" value="<?php echo e(!empty(old('usermeta.billing_city')) ? old('usermeta.billing_city') : $user->billing_city); ?>">

                                <?php if($errors->has('usermeta.billing_city')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('usermeta.billing_city')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group<?php echo e($errors->has('usermeta.billing_zip') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_zip]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.zip_code'); ?></label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_zip]" type="text" class="form-control" name="usermeta[billing_zip]" value="<?php echo e(!empty(old('usermeta.billing_zip')) ? old('usermeta.billing_zip') : $user->billing_zip); ?>">

                                <?php if($errors->has('usermeta.billing_zip')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('usermeta.billing_zip')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group<?php echo e($errors->has('usermeta.billing_country') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_country]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.country'); ?></label>

                            <div class="col-md-6">
                                <select id="usermeta[billing_country]" type="text" class="form-control user-country" name="usermeta[billing_country]">
                                    
                                    <option><?php echo app('translator')->get('account.profile.select_country'); ?></option>
                                    <?php if( $countries->count() > 0 ): ?> 
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            <option value="<?php echo e($key); ?>" <?php echo e((isset($user->billing_country->id) && $key == $user->billing_country->id) || $key == old('usermeta.billing_country') ? 'SELECTED' : ''); ?>><?php echo e($country); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    
                                </select>

                                <?php if($errors->has('usermeta.billing_country')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('usermeta.billing_country')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php echo e($errors->has('usermeta.billing_state') ? ' has-error' : ''); ?>">
                            <label for="usermeta[billing_state]" class="col-md-4 control-label"><?php echo app('translator')->get('account.profile.state'); ?></label>

                            <div class="col-md-6 user-state">
                                <div class='state-container'>
                                    <select id="usermeta[billing_state]" type="text" class="form-control" name="usermeta[billing_state]">

                                        <option><?php echo app('translator')->get('account.profile.select_state'); ?></option>
                                        <?php if( $states->count() > 0 ): ?> 
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <option value="<?php echo e($key); ?>" <?php echo e($key == $user->billing_state || $key == old('usermeta.billing_state')  ? 'SELECTED' : ''); ?>><?php echo e($state); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </select>
                                </div>

                                <?php if($errors->has('usermeta.billing_state')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('usermeta.billing_state')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo app('translator')->get('account.profile.save_details'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script id="states-template" type="text/x-handlebars-template">
    <select class="form-control" name="usermeta[billing_state]">
        <option value=""><?php echo app('translator')->get('account.profile.select_state'); ?></option>
        {{#each this}}
            <option value="{{ @key  }}">{{this}}</option>
        {{/each}}    
    </select>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/account/edit.blade.php ENDPATH**/ ?>