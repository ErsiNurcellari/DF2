<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="row">

    <?php echo Form::model( $form, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.form.update', $form->id ], 'class' => 'form' ] ); ?>


        <?php echo $__env->make('admin.form.partials.form', ['submitLabel' => 'Update'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::close(); ?>


    <?php echo $__env->make('admin.form.partials.builder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/form/edit.blade.php ENDPATH**/ ?>