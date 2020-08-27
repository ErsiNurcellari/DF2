<?php if( setting('social_login.enabled', 'no') == 'yes' ): ?> 
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo app('translator')->get('auth.social.login_with'); ?></div>
        <div class="panel-body">
            <div class="form-group">
                <div class="">

                    <?php if( setting('services.facebook.enabled') == 'yes' ): ?>
                    <a title="<?php echo app('translator')->get('auth.social.login_with'); ?> Facebook" href="<?php echo e(site_url('/auth/facebook')); ?>" class="btn btn-facebook"><img src="<?php echo e(asset('assets/themes/default/img/facebook.png')); ?>" alt="<?php echo app('translator')->get('auth.social.login_with'); ?> Facebook"></a>
                    <?php endif; ?>

                    <?php if( setting('services.twitter.enabled') == 'yes' ): ?>
                    <a title="<?php echo app('translator')->get('auth.social.login_with'); ?> Twitter" href="<?php echo e(site_url('/auth/twitter')); ?>" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
                    <?php endif; ?>

                    <?php if( setting('services.envato.enabled') == 'yes' ): ?>
                    <a title="<?php echo app('translator')->get('auth.social.login_with'); ?> Envato" href="<?php echo e(site_url('/auth/envato')); ?>" class="btn btn-github"><img src="<?php echo e(asset('assets/themes/default/img/envato.png')); ?>" alt="<?php echo app('translator')->get('auth.social.login_with'); ?> Envato"></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/auth/social.blade.php ENDPATH**/ ?>