<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="row">


    <?php echo Form::model($settings, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.settings.update', 1 ] ]); ?>



    <div class="col-md-12">

        <?php echo $__env->make('admin.layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('admin.settings.partials.'.$section, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="form-group row">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </div>


    <?php echo Form::close(); ?>



</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>