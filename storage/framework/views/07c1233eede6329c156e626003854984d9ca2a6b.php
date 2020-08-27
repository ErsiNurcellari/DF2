<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="row">


    <?php echo Form::open(['url' => 'ch-admin/addon', 'class' => 'addon-form']); ?>


        <?php echo $__env->make('admin.addon.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::close(); ?>



    <?php echo $__env->make('admin.addon.listing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/addon/create.blade.php ENDPATH**/ ?>