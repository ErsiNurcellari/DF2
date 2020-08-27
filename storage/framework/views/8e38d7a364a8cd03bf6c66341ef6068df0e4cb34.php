

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($total_completed); ?></h3>

                    <p>Completed Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo e(route('ch-admin.order.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e($total_processing); ?></h3>

                    <p>Processing Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-code-working"></i>
                </div>
                <a href="<?php echo e(route('ch-admin.order.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo e($total_pending); ?></h3>

                    <p>Pending Payment Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-load-c"></i>
                </div>
                <a href="<?php echo e(route('ch-admin.order.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo e($total_cancelled); ?></h3>
                    <p>Cancelled Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-minus-circled"></i>
                </div>
                <a href="<?php echo e(route('ch-admin.order.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>


    <div class="row">

        <div class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    

                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales Last 30 days</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"></div>
                    <div class="chart tab-pane" id="sales-chart"></div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->
        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('ch_footer'); ?>
    <script src="<?php echo e(asset('assets/backend/js/vendors/raphael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/vendors/morris.min.js')); ?>"></script>

    <script>
        var area = new Morris.Area({
            element   : 'revenue-chart',
            resize    : true,
            xkey      : 'y',
            ykeys     : ['sales'],
            labels    : ['Sale'],
            lineColors: ['#a0d0e0'],
            hideHover : 'auto',
            data      : <?php echo $sales; ?>

        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>