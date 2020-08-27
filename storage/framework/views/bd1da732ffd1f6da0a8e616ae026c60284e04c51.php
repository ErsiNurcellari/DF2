<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">


        <?php echo Form::open(['url' => 'ch-admin/language']); ?>


            <?php echo e(method_field('POST')); ?>


            <?php echo $__env->make('admin.language.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo Form::close(); ?>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/language/create.blade.php ENDPATH**/ ?>