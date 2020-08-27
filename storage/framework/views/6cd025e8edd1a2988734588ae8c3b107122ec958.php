<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="row">


    <?php echo Form::open(['url' => 'ch-admin/category', 'class' => 'product-form']); ?>


        <?php echo $__env->make('admin.category.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::close(); ?>



    <?php echo $__env->make('admin.category.listing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/category/create.blade.php ENDPATH**/ ?>