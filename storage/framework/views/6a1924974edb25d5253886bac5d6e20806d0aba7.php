<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1><?php echo app('translator')->get("menu.$heading"); ?></h1>
                <?php echo $content; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('themes.default.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/page.blade.php ENDPATH**/ ?>