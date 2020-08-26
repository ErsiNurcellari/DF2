@extends('themes.default.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 @if ( setting('social_login.enabled', 'no') == 'no' ) col-md-offset-2 @endif">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('menu.register')</div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">@lang('auth.username')</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('auth.email_address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 control-label">@lang('auth.confirm_password')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
                                <p class="help-block">@lang('auth.terms_and_conditions', ['url' => url('page/terms-of-service')])</p>
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.btn_register')
                                </button>
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
