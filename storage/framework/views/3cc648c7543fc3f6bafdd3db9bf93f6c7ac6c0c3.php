<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Category Information</h3>
        </div>
        <div class="box-body">

            <?php echo $__env->make('admin.layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group">
                <?php echo Form::label('name', 'Category name:'); ?>

                <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category name here']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::label('description', 'Description:'); ?>

                <?php echo Form::textarea('description', null, ['class' => 'form-control ckeditor']); ?>

            </div>
            
            <div class="form-group">
                <?php echo Form::label('term_list', ' Parent:'); ?>

                <?php echo Form::select('parent', $categoryArray, null, ['class' => 'form-control']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::input('submit', 'submit', 'Save Category', ['class' => 'btn btn-primary']); ?>

                <?php if( Request::is('*/edit') ): ?>
                    <a href="<?php echo e(route('ch-admin.category.index')); ?>" class="btn btn-default">Cancel</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/category/partials/form.blade.php ENDPATH**/ ?>