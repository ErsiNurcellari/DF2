<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 <?php if( setting('social_login.enabled', 'no') == 'no' ): ?> col-md-offset-2 <?php endif; ?>">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo app('translator')->get('menu.login'); ?></div>

                <div class="panel-body">

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('warning')): ?>
                        <div class="alert alert-warning">
                            <?php echo e(session('warning')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label"><?php echo app('translator')->get('auth.email_address'); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo app('translator')->get('auth.remember_me'); ?>
                                    </label>
                                </div>
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
                                <button type="submit" class="btn btn-primary">
                                    <?php echo app('translator')->get('auth.btn_login'); ?>
                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo app('translator')->get('auth.forget_password'); ?>
                                </a>
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
<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/auth/login.blade.php ENDPATH**/ ?>