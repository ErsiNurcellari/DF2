<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="row">


    <?php echo Form::model($category, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.category.update', $category->id ] ]); ?>


        <?php echo $__env->make('admin.category.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::close(); ?>


</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/category/edit.blade.php ENDPATH**/ ?>