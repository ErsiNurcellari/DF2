@extends('themes.default.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-3">
            @include('themes.default.account.nav')
        </div>
        
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('account.profile.edit_account')</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('ch_update_details') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">@lang('account.profile.username')</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" readonly>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">@lang('account.profile.first_name')</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ !empty(old('first_name')) ? old('first_name') : $user->first_name }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">@lang('account.profile.last_name')</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ !empty(old('last_name')) ? old('last_name') : $user->last_name }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('account.profile.email_address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-4 control-label">@lang('account.profile.current_password')</label>

                            <div class="col-md-6">
                                <input id="current_password" type="current_password" class="form-control" name="current_password">
                                <small class="help-block">@lang('account.profile.change_pass_note')</small>
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-4 control-label">@lang('account.profile.new_password')</label>

                            <div class="col-md-6">
                                <input id="new_password" type="new_password" class="form-control" name="new_password">
                                <small class="help-block">@lang('account.profile.new_pass_note')</small>
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <h4>@lang('account.profile.billing_info')</h4>
                        <hr>
                        
                        <div class="form-group{{ $errors->has('usermeta.billing_address') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_address]" class="col-md-4 control-label">@lang('account.profile.address')</label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_address]" type="text" class="form-control" name="usermeta[billing_address]" value="{{ !empty(old('usermeta.billing_address')) ? old('usermeta.billing_address') : $user->billing_address }}">

                                @if ($errors->has('usermeta.billing_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usermeta.billing_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('usermeta.billing_city') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_city]" class="col-md-4 control-label">@lang('account.profile.city')</label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_city]" type="text" class="form-control" name="usermeta[billing_city]" value="{{ !empty(old('usermeta.billing_city')) ? old('usermeta.billing_city') : $user->billing_city }}">

                                @if ($errors->has('usermeta.billing_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usermeta.billing_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('usermeta.billing_zip') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_zip]" class="col-md-4 control-label">@lang('account.profile.zip_code')</label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_zip]" type="text" class="form-control" name="usermeta[billing_zip]" value="{{ !empty(old('usermeta.billing_zip')) ? old('usermeta.billing_zip') : $user->billing_zip }}">

                                @if ($errors->has('usermeta.billing_zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usermeta.billing_zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('usermeta.billing_country') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_country]" class="col-md-4 control-label">@lang('account.profile.country')</label>

                            <div class="col-md-6">
                                <select id="usermeta[billing_country]" type="text" class="form-control user-country" name="usermeta[billing_country]">
                                    
                                    <option>@lang('account.profile.select_country')</option>
                                    @if ( $countries->count() > 0 ) 
                                        @foreach ( $countries as $key => $country ) 
                                            <option value="{{$key}}" {{ (isset($user->billing_country->id) && $key == $user->billing_country->id) || $key == old('usermeta.billing_country') ? 'SELECTED' : '' }}>{{$country}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>

                                @if ($errors->has('usermeta.billing_country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usermeta.billing_country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('usermeta.billing_state') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_state]" class="col-md-4 control-label">@lang('account.profile.state')</label>

                            <div class="col-md-6 user-state">
                                <div class='state-container'>
                                    <select id="usermeta[billing_state]" type="text" class="form-control" name="usermeta[billing_state]">

                                        <option>@lang('account.profile.select_state')</option>
                                        @if ( $states->count() > 0 ) 
                                            @foreach ( $states as $key => $state ) 
                                                <option value="{{$key}}" {{ $key == $user->billing_state || $key == old('usermeta.billing_state')  ? 'SELECTED' : '' }}>{{$state}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>

                                @if ($errors->has('usermeta.billing_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usermeta.billing_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('account.profile.save_details')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script id="states-template" type="text/x-handlebars-template">
    <select class="form-control" name="usermeta[billing_state]">
        <option value="">@lang('account.profile.select_state')</option>
        @{{#each this}}
            <option value="@{{ @key }}">@{{this}}</option>
        @{{/each}}    
    </select>
</script>
@endsection
