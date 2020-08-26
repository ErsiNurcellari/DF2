<div class="col-md-8">

    @include('admin.layouts.errors')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User details</h3>
        </div>
        <div class="box-body">
            
            <div class="form-group">
                {!! Form::label('username', 'Username:') !!}
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('first_name', 'First name:') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('last_name', 'Last name:') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name']) !!}
            </div>
            
            
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::text('password', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                {!! Route::currentRouteName() == 'ch-admin.user.edit' ? '<small class="help-block">Leave blank to keep the existing one.</small>' : '' !!}
            </div>

            <div class="form-group">
                {!! Form::label('roles', ' Role:') !!}
                {!! Form::select('roles', $roles, null, ['class' => 'form-control']) !!}
            </div>
            
            
            <h3>Billing Details:</h3>
            <hr>
            
            <div class="form-group">
                {!! Form::label('usermeta[billing_address]', 'Billing Address (optional):') !!}
                {!! Form::text('usermeta[billing_address]', null, ['class' => 'form-control', 'placeholder' => 'Billing Address']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('usermeta[billing_city]', 'Billing City (optional):') !!}
                {!! Form::text('usermeta[billing_city]', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
            </div>
            
            
            <div class="form-group">
                {!! Form::label('usermeta[billing_zip]', 'Billing Zip/Postal Code (optional):') !!}
                {!! Form::text('usermeta[billing_zip]', null, ['class' => 'form-control', 'placeholder' => 'Zip/Postal Code']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('usermeta[billing_country]', 'Billing Country (optional):') !!}
                {!! Form::select('usermeta[billing_country]', ['' => 'Please select'] + $countries, null, ['class' => 'form-control user-country']) !!}
            </div>
            
            <div class="form-group user-state">
                {!! Form::label('state', 'State (optional):') !!}
                <div class="state-container">
                    @if(Route::currentRouteName() === 'ch-admin.service.edit')
                        {!! Form::text('usermeta[billing_state]', null, ['class' => 'form-control', 'placeholder' => 'State']) !!}
                    @else 
                        {!! Form::select('usermeta[billing_state]', $states, null, ['class' => 'form-control user-state']) !!}
                    @endif
                    
                </div>
            </div>
            
            <div class="form-group">
                {!! Form::input('submit', 'publish', $submitLabel, ['class' => 'btn btn-primary']) !!}
                <a href="{{route('ch-admin.user.index')}}" class="btn btn-default">Cancel</a>
            </div>
            
            
        </div>
    </div>

</div>


<script id="states-template" type="text/x-handlebars-template">
    <select class="form-control" name="usermeta[billing_state]">
        <option value="">Select State/Province</option>
        @{{#each this}}
            <option value="@{{ @key }}">@{{this}}</option>
        @{{/each}}    
    </select>
</script>