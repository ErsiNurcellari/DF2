<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | ChargePanda</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('assets/backend/css/main.css')}}">
    <meta name="_token" content="{!! csrf_token() !!}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{asset('assets/backend/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{asset('assets/backend/css/app.css')}}">
    <!-- Google Font -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script>
        var base_url = '{{site_url('/')}}';
    </script>
    @yield('ch_header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{site_url('/')}}" class="logo" target="_blank">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>C</b>P</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Charge</b>Panda</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    @include('admin.layouts.notifications_popup')

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ get_gravatar( \Auth()->user()->email ) }}" class="user-image" alt="{{ \Auth()->user()->name }}">
                            <span class="hidden-xs">{{ \Auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ get_gravatar( \Auth()->user()->email, 160 ) }}" class="img-circle" alt="{{ \Auth()->user()->name }}">

                                <p>
                                    {{ \Auth()->user()->name }}
                                    <small>Member since {{ \Auth()->user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>

                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
<!--                <li class="header">MAIN NAVIGATION</li>-->
                <li  class="{{ch_active_item('/ch-admi', 'active')}}">
                    <a href="{{route(('ch-admin.ch_admin_dashboard'))}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ch_active_item('updates', 'active')}}">
                    <a href="{{route('ch-admin.ch_admin_update')}}"><i class="fa fa-download"></i> <span>Updates</span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green">New</small>       
                        </span>
                    </a>
                </li>
                <li class="{{ch_active_item('addon', 'active')}}"><a href="{{route('ch-admin.addon.index')}}"><i class="fa fa-puzzle-piece"></i> <span>Addons</span></a></li>

                <li class="{{ch_active_item('service', 'active')}}"><a href="{{route('ch-admin.service.index')}}"><i class="fa fa-cogs"></i> <span>Services</span></a></li>

                <li class="{{ch_active_item('form', 'active')}}"><a href="{{route('ch-admin.form.index')}}"><i class="fa fa-wpforms"></i> <span>Forms</span></a></li>

                <li class="{{ch_active_item('order', 'active')}}"><a href="{{route('ch-admin.order.index')}}"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>

                <li class="{{ch_active_item('category', 'active')}}"><a href="{{route('ch-admin.category.index')}}"><i class="fa fa-briefcase"></i> <span>Categories</span></a></li>

                <li class="{{ch_active_item('user', 'active')}}"><a href="{{route('ch-admin.user.index')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>

                <li class="{{ch_active_item('language', 'active')}}"><a href="{{route('ch-admin.language.index')}}"><i class="fa fa-language"></i> <span>Languages</span></a></li>

                <li class="{{ch_active_item('settings', 'active menu-open')}} treeview">
                    <a href="{{route('ch-admin.settings.index')}}"><i class="fa fa-cogs"></i> <span>Settings</span></a>
                    <ul class="treeview-menu">
                        <li class="{{ch_active_item('settings/general', 'active')}}"><a href="{{route('ch-admin.settings.show', ['general'])}}"><i class="fa fa-circle-o"></i> General</a></li>
                        <li class="{{ch_active_item('settings/seo', 'active')}}"><a href="{{route('ch-admin.settings.show', ['seo'])}}"><i class="fa fa-circle-o"></i> SEO</a></li>
                        <li class="{{ch_active_item('settings/mail', 'active')}}"><a href="{{route('ch-admin.settings.show', ['mail'])}}"><i class="fa fa-circle-o"></i> Mail</a></li>
                        <li class="{{ch_active_item('settings/payments', 'active')}}"><a href="{{route('ch-admin.settings.show', ['payments'])}}"><i class="fa fa-circle-o"></i> Payment</a></li>
                        <li class="{{ch_active_item('settings/taxes', 'active')}}"><a href="{{route('ch-admin.settings.show', ['taxes'])}}"><i class="fa fa-circle-o"></i> Taxes</a></li>
                        <li class="{{ch_active_item('settings/social_logins', 'active')}}"><a href="{{route('ch-admin.settings.show', ['social_logins'])}}"><i class="fa fa-circle-o"></i> Social Login</a></li>
                        <li class="{{ch_active_item('settings/update', 'active')}}"><a href="{{route('ch-admin.settings.show', ['update'])}}"><i class="fa fa-circle-o"></i> Update</a></li>
                        <li class="{{ch_active_item('settings/site_pages', 'active')}}"><a href="{{route('ch-admin.settings.show', ['site_pages'])}}"><i class="fa fa-circle-o"></i> Site Pages</a></li>
                        <li class="{{ch_active_item('settings/code_analytics', 'active')}}"><a href="{{route('ch-admin.settings.show', ['code_analytics'])}}"><i class="fa fa-circle-o"></i> Code & Analytics</a></li>
                    </ul>
                </li>
                <li><a href="https://www.ChargePanda.com/docs/" target="_blank"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                <li><a href="https://www.chargepanda.com/docs/docs/get-started/changelog/" target="_blank"><i class="fa fa-book"></i> <span>Changelog</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            @if ( isset($isUpToDate) && $isUpToDate == false )
                <div class="alert alert-info">A newer version <strong>{{setting('remote_version')}}</strong> of your ChargePanda is available.</div>
            @endif

            <h1>{{ isset($title) ? $title : '' }}</h1>

            @include('flash::message')
        </section>

        <!-- Main content -->



        <section class="content">

            <!-- Default box -->
            @yield('content')
            <!-- /.box -->

        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> {{VERSION}}
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="https://www.ChargePanda.com">ChargePanda</a>.</strong> All rights reserved.
    </footer>


</div>
<!-- ./wrapper -->

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/backend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{asset('assets/backend/js/all.js')}}"></script>
@stack('ch_footer')
</body>
</html>
