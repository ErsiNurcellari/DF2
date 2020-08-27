<div class="panel panel-default">
    <div class="panel-heading"><?php echo app('translator')->get('nav-title'); ?></div>

    <div class="panel-body account-menu-ctn">
        <ul class="account-menu">
            <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('menu.home'); ?></a></li>
            <li><a href="<?php echo e(route('ch_edit_details')); ?>"><?php echo app('translator')->get('menu.account-details'); ?></a></li>
            <li><a href="<?php echo e(route('ch_user_orders')); ?>"><?php echo app('translator')->get('menu.orders'); ?></a></li>
            <li><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-account').submit();"><?php echo app('translator')->get('menu.logout'); ?></a>
                <form id="logout-form-account" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </li>
        </ul>
    </div>
</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/account/nav.blade.php ENDPATH**/ ?>