<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 <?php if( setting('social_login.enabled', 'no') == 'no' ): ?> col-md-offset-2 <?php endif; ?>">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo app('translator')->get('menu.register'); ?></div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username" class="col-md-4 control-label"><?php echo app('translator')->get('auth.username'); ?></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required>

                                <?php if($errors->has('username')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('username')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label"><?php echo app('translator')->get('auth.email_address'); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label"><?php echo app('translator')->get('auth.password'); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"><?php echo app('translator')->get('auth.confirm_password'); ?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('recaptcha') ? ' has-error' : ''); ?>">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="g-recaptcha" data-sitekey="<?php echo e(setting('recaptcha.api_site_key')); ?>"></div>

                                <?php if($errors->has('recaptcha')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('recaptcha')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <p class="help-block"><?php echo app('translator')->get('auth.terms_and_conditions', ['url' => url('page/terms-of-service')]); ?></p>
                                <button type="submit" class="btn btn-primary">
                                    <?php echo app('translator')->get('auth.btn_register'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <?php echo $__env->make('auth.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php if(setting('recaptcha.enabled') == 'on'): ?>
    <?php $__env->startPush('ch_header'); ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/auth/register.blade.php ENDPATH**/ ?>