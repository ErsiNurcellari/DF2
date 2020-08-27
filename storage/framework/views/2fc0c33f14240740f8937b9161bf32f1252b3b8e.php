<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(ch_get_title(isset($title) ? $title : '')); ?></title>

    <?php if(Route::is('home')): ?>
        <meta name="description" content="<?php echo e(\setting('seo.home_desc')); ?>"/>
    <?php endif; ?>

    <?php if(!Route::is('home') && isset($description)): ?>
        <meta name="description" content="<?php echo e($description); ?>"/>
    <?php endif; ?>

    <?php echo ch_get_favicon(); ?>


    <link rel="canonical" href="<?php echo e(site_url(request()->path())); ?>">
    <!-- Styles -->
    <link href="<?php echo e(asset('assets/themes/default/css/app.css')); ?>" rel="stylesheet">
    <script src="//use.edgefonts.net/source-sans-pro:n2,i2,n3,i3,n4,i4,n6,i6,n7,i7,n9,i9:all.js"></script>
    <script>
        var base_url = '<?php echo e(site_url('/')); ?>';
        <?php if(auth()->check()): ?>
            var logged_in = true;
        <?php endif; ?>
        var stripe_key = <?php echo setting('stripe.sandbox_mode', 'yes') == 'yes' ? '"'.setting("stripe.sandbox.pk").'"' : '"'.setting("stripe.live.pk").'"'; ?>;
    </script>
    <?php echo $__env->yieldPushContent('ch_header'); ?>
    <?php echo setting('header_code'); ?>

    <style>
        <?php echo setting('custom_css'); ?>

    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="<?php echo e(site_url('/')); ?>">
                    <?php echo get_logo(); ?>

                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <?php echo get_menu($categories); ?>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('menu.login'); ?></a></li>
                        <li><a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('menu.register'); ?></a></li>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                <?php echo e(Auth::user()->username); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">

                                <?php if( \Auth::user()->hasRole('administrator') ): ?>
                                    <li><a href="<?php echo e(site_url('/ch-admin')); ?>"><?php echo app('translator')->get('menu.admin'); ?></a></li>
                                <?php endif; ?>

                                <li><a href="<?php echo e(route('ch_user_orders')); ?>"><?php echo app('translator')->get('menu.orders'); ?></a></li>
                                <li><a href="<?php echo e(route('ch_edit_details')); ?>"><?php echo app('translator')->get('menu.account-details'); ?></a></li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo app('translator')->get('menu.logout'); ?>
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if($active_languages->count() > 1): ?>
                        <li class="nav-item dropdown language-dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="langdropdown"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                        class="flag flag-<?php echo e($default_lang->locale); ?>"> </span> <?php echo e($default_lang->locale); ?>

                            </a>
                            <div class="dropdown-menu" aria-labelledby="langdropdown">
                                <?php $__currentLoopData = $active_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if((session()->has('locale') && $language->locale == session()->get('locale')) || $default_lang->locale == $language->locale): ?>
                                        <?php continue; ?>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="<?php echo e(route('switch_lang', [$language->locale])); ?>"><span
                                                class="flag flag-<?php echo e($language->locale); ?>"></span> <?php echo e($language->locale); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php echo $__env->make('themes.default.account.notifications_popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldContent('content'); ?>


    <footer class="site-footer clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p><a href="<?php echo e(site_url('page/terms-of-service')); ?>"><?php echo app('translator')->get('menu.terms-of-service'); ?></a> | <a
                                href="<?php echo e(site_url('page/privacy-policy')); ?>"><?php echo app('translator')->get('menu.privacy-policy'); ?></a> | <a
                                href="<?php echo e(site_url('page/refund-policy')); ?>"><?php echo app('translator')->get('menu.refund-policy'); ?></a> | <a
                                href="<?php echo e(site_url('page/contact')); ?>"><?php echo app('translator')->get('menu.contact'); ?></a></p>
                    <p><?php echo app('translator')->get('copyright', ['name'=> setting('app.name', 'ChargePanda')]); ?></p>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="<?php echo e(asset('assets/themes/default/js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/themes/default/js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('ch_footer'); ?>
<?php echo setting('footer_code'); ?>

</body>
</html>
<?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/themes/default/app.blade.php ENDPATH**/ ?>