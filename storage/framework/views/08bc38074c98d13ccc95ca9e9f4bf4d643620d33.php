<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Addon Information</h3>
        </div>
        <div class="box-body">

            <?php echo $__env->make('admin.layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group">
                <?php echo Form::label('name', 'Name:'); ?>

                <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name here']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::label('description', 'Short Description:'); ?>

                <?php echo Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Short description here']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::input('submit', 'submit', 'Save Addon', ['class' => 'btn btn-primary']); ?>

                <?php if( Request::is('*/edit') ): ?>
                    <a href="<?php echo e(route('ch-admin.addon.index')); ?>" class="btn btn-default">Cancel</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/addon/partials/form.blade.php ENDPATH**/ ?>