<div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Addons</h3>

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
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($addon->id); ?></th>
                        <td><a href="<?php echo e(route( 'ch-admin.addon.edit', $addon->id )); ?>"><?php echo e($addon->name); ?></a></td>
                        <td><?php echo e($addon->description); ?></td>
                        <td><a href="<?php echo e(action( 'Admin\AdminAddonController@edit', $addon->id )); ?>">Edit</a></td>
                        <td>
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['ch-admin.addon.destroy', $addon->id]]); ?>

                            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?');"]); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="box-footer clearfix">
            <?php echo e($addons ?? ''->setPath('addon')->links()); ?>

        </div>

    </div>

</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/addon/listing.blade.php ENDPATH**/ ?>