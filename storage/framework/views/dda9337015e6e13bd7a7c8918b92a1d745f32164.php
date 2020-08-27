

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php if( setting( 'purchase_code' ) == '' ||  setting( 'cc_token' ) == '' ): ?>
                <div class="alert alert-warning">To get automatic updates from ChargePanda you need to save your Purchase code and CodeCanyon.net API key in <a href="<?php echo e(route('ch-admin.settings.show', ['update'])); ?>">Settings -> Update</a></div>
            <?php else: ?> 
            <p>Last checked on <?php echo e(setting('update_last_check') == '' ? 'Never' : date('M d, Y h:i:s A', setting('update_last_check'))); ?>.</p>
                <form action="" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="submit" name="check_updates" value="Check Again" class="btn btn-default">
                </form>
            
                <?php if( isUpToDate() == false ): ?>
                    <h3>An updated version of ChargePanda is available.</h3>
                    <p>You can update to ChargePanda latest version automatically:</p>
                    
                    
                    <?php if( session('update_status') != 'downloaded' ): ?> 

                        <form action="" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="submit" name="download_now" value="Prepare Download files" class="btn btn-primary">
                        </form>
                    
                    <?php else: ?>
                    
                        <form action="" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="submit" name="update_now" value="Update now" class="btn btn-primary">
                        </form>
                    
                    <?php endif; ?>
                    <p>While your site is being updated, it will be in maintenance mode. As soon as your updates are complete, your site will return to normal.</p>
                
                <?php else: ?>     
                    
                    <h3>You have the latest version of ChargePanda.</h3>
                
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/updates.blade.php ENDPATH**/ ?>