<?php $__env->startSection('title', 'Languages'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo e($title); ?> <a class="btn btn-primary" href="<?php echo e(route('ch-admin.language.create')); ?>">Add New</a></h3>

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
                        <th>Name</th>
                        <th>Locale</th>
                        <th>Enabled</th>
                        <th>Default</th>
                        <th>Edit Phrases</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($language->id); ?></td>
                        <td><?php echo e($language->name); ?></td>
                        <td><?php echo e($language->locale); ?></td>

                        <td>
                            <?php echo Form::open(['method' => 'PATCH', 'route' => ['ch-admin.language.update', $language->id]]); ?>

                                <?php if($language->default): ?>
                                    <span class="label label-warning">Default language.</span>
                                <?php elseif($language->enabled): ?>
                                    <?php echo Form::hidden('enabled', 0); ?>

                                    <?php echo Form::submit('Disable', ['class' => 'btn btn-sm btn-warning', $language->default == 1 ? 'disabled' : '']); ?>

                                <?php else: ?>
                                    <?php echo Form::hidden('enabled', 1); ?>

                                    <?php echo Form::submit('Enabled', ['class' => 'btn btn-sm btn-info']); ?>

                                <?php endif; ?>
                            <?php echo Form::close(); ?>

                        </td>

                        <td>

                            <?php if($language->default == 1): ?>
                                <span class="label label-success">Default Language</span>
                            <?php elseif($language->enabled): ?>
                                <?php echo Form::open(['method' => 'PATCH', 'route' => ['ch-admin.language.update', $language->id]]); ?>

                                    <?php echo Form::submit('Set as Default', ['class' => 'btn btn-sm btn-info']); ?>

                                    <?php echo Form::hidden('default', 1); ?>

                                <?php echo Form::close(); ?>

                            <?php else: ?>
                                <span class="label label-warning">Language not enabled.</span>
                            <?php endif; ?>
                        </td>

                        <td><a href="<?php echo e(route('ch-admin.phrases.edit', [$language->id])); ?>" class="btn btn-sm btn-info">Edit</a></td>
                        <td><a href="<?php echo e(route('ch-admin.language.edit', [$language->id])); ?>" class="btn btn-sm btn-info">Edit</a></td>
                        <td>
                            <?php if($language->id != 1): ?>
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['ch-admin.language.destroy', $language->id]]); ?>

                                <?php echo Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this language?');"]); ?>

                            <?php echo Form::close(); ?>

                            <?php else: ?>
                                <span class="label label-warning">Cannot be deleted.</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8">No languages found.</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">

            </div>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/language/index.blade.php ENDPATH**/ ?>