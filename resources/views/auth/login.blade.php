@extends('themes.default.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 @if ( setting('social_login.enabled', 'no') == 'no' ) col-md-offset-2 @endif">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('menu.login')</div>

                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('auth.email_address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">@lang('auth.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('auth.remember_me')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('recaptcha') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="g-recaptcha" data-sitekey="{{setting('recaptcha.api_site_key')}}"></div>

                                @if ($errors->has('recaptcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('recaptcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.btn_login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('auth.forget_password')
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('auth.social')

    </div>
</div>
@endsection

@if(setting('recaptcha.enabled') == 'on')
    @push('ch_header')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endif