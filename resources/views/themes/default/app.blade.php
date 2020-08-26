<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{ch_get_title(isset($title) ? $title : '')}}</title>

    @if(Route::is('home'))
        <meta name="description" content="{{\setting('seo.home_desc')}}"/>
    @endif

    @if(!Route::is('home') && isset($description))
        <meta name="description" content="{{$description}}"/>
    @endif

    {!! ch_get_favicon() !!}

    <link rel="canonical" href="{{site_url(request()->path())}}">
    <!-- Styles -->
    <link href="{{ asset('assets/themes/default/css/app.css') }}" rel="stylesheet">
    <script src="//use.edgefonts.net/source-sans-pro:n2,i2,n3,i3,n4,i4,n6,i6,n7,i7,n9,i9:all.js"></script>
    <script>
        var base_url = '{{site_url('/')}}';
        @if(auth()->check())
            var logged_in = true;
        @endif
        var stripe_key = {!! setting('stripe.sandbox_mode', 'yes') == 'yes' ? '"'.setting("stripe.sandbox.pk").'"' : '"'.setting("stripe.live.pk").'"' !!};
    </script>
    @stack('ch_header')
    {!! setting('header_code') !!}
    <style>
        {!! setting('custom_css') !!}
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
                <a class="navbar-brand" href="{{ site_url('/') }}">
                    {!! get_logo() !!}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    {!! get_menu($categories) !!}
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">@lang('menu.login')</a></li>
                        <li><a href="{{ route('register') }}">@lang('menu.register')</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">

                                @if ( \Auth::user()->hasRole('administrator') )
                                    <li><a href="{{ site_url('/ch-admin') }}">@lang('menu.admin')</a></li>
                                @endif

                                <li><a href="{{route('ch_user_orders')}}">@lang('menu.orders')</a></li>
                                <li><a href="{{route('ch_edit_details')}}">@lang('menu.account-details')</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('menu.logout')
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest

                    @if ($active_languages->count() > 1)
                        <li class="nav-item dropdown language-dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="langdropdown"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                        class="flag flag-{{$default_lang->locale}}"> </span> {{$default_lang->locale}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="langdropdown">
                                @foreach($active_languages as $language)
                                    @if((session()->has('locale') && $language->locale == session()->get('locale')) || $default_lang->locale == $language->locale)
                                        @continue
                                    @endif
                                    <a class="dropdown-item" href="{{route('switch_lang', [$language->locale])}}"><span
                                                class="flag flag-{{$language->locale}}"></span> {{$language->locale}}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                </ul>

                @include('themes.default.account.notifications_popup')

                <form class="navbar-form navbar-right" action="{{route('search')}}">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                   placeholder="@lang('search')" @isset($q)value="{{$q}}@endisset"/>
                            <span class="input-group-btn">
        <button class="btn btn-default" type="submit">
            <i class="fa fa-search"></i>
        </button>
      </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
            </div>
        </div>
    </div>

    @yield('content')


    <footer class="site-footer clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p><a href="{{ site_url('page/terms-of-service') }}">@lang('menu.terms-of-service')</a> | <a
                                href="{{ site_url('page/privacy-policy') }}">@lang('menu.privacy-policy')</a> | <a
                                href="{{ site_url('page/refund-policy') }}">@lang('menu.refund-policy')</a> | <a
                                href="{{ site_url('page/contact') }}">@lang('menu.contact')</a></p>
                    <p>@lang('copyright', ['name'=> setting('app.name', 'ChargePanda')])</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('assets/themes/default/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/themes/default/js/app.js') }}"></script>
@stack('ch_footer')
{!! setting('footer_code') !!}
</body>
</html>
