<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Addon Information</h3>
        </div>
        <div class="box-body">

            @include('admin.layouts.errors')

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name here']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Short Description:') !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Short description here']) !!}
            </div>

            <div class="form-group">
                {!! Form::input('submit', 'submit', 'Save Addon', ['class' => 'btn btn-primary']) !!}
                @if ( Request::is('*/edit') )
                    <a href="{{route('ch-admin.addon.index')}}" class="btn btn-default">Cancel</a>
                @endif
            </div>

        </div>
    </div>
</div>