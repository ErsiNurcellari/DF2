<?php $__env->startSection('title', 'Forms'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo e($title); ?> <a class="btn btn-primary" href="<?php echo e(route('ch-admin.form.create')); ?>">Add New</a></h3>

                <form action="">

                </form>
                <div class="box-tools">
                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input name="s" class="form-control pull-right" placeholder="Search" type="text" value="<?php echo e(Request::input('s')); ?>">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body table-responsive no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($form->id); ?></th>
                        <td><a href="<?php echo e(route( 'ch-admin.form.edit', [$form->id])); ?>"><?php echo e($form->name); ?></a></td>
                        <td><a href="<?php echo e(route( 'ch-admin.form.edit', [$form->id])); ?>">Edit</a></td>
                        <td>

                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['ch-admin.form.destroy', $form->id]]); ?>

                                <?php echo Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?');"]); ?>

                            <?php echo Form::close(); ?>


                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">
                <?php echo e($forms->links()); ?>

            </div>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/form/index.blade.php ENDPATH**/ ?>