<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Language Information</h3>
        </div>
        <div class="box-body">

            <?php echo $__env->make('admin.layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group">
                <?php echo Form::label('name', 'Language name:'); ?>

                <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Language name here']); ?>

            </div>

            <?php if( !isset($language) || (isset($language) && $language->locale != 'en') ): ?>
            <div class="form-group">
                <?php echo Form::label('locale', 'Locale:'); ?>

                <?php echo Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'i.e. en']); ?>

            </div>
            <?php endif; ?>

            <div class="form-group">
                <?php echo Form::label('direction', 'Direction:'); ?>

                <?php echo Form::select('direction', ['ltr' => 'Left to Right', 'rtl' => 'Right to Left'], null, ['class' => 'form-control']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::input('submit', 'submit', 'Save Language', ['class' => 'btn btn-primary']); ?>

                <?php if( Request::is('*/edit') ): ?>
                    <a href="<?php echo e(route('ch-admin.language.index')); ?>" class="btn btn-default">Cancel</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/language/partials/form.blade.php ENDPATH**/ ?>