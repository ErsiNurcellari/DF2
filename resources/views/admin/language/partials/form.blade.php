<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Language Information</h3>
        </div>
        <div class="box-body">

            @include('admin.layouts.errors')

            <div class="form-group">
                {!! Form::label('name', 'Language name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Language name here']) !!}
            </div>

            @if ( !isset($language) || (isset($language) && $language->locale != 'en') )
            <div class="form-group">
                {!! Form::label('locale', 'Locale:') !!}
                {!! Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'i.e. en']) !!}
            </div>
            @endif

            <div class="form-group">
                {!! Form::label('direction', 'Direction:') !!}
                {!! Form::select('direction', ['ltr' => 'Left to Right', 'rtl' => 'Right to Left'], null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::input('submit', 'submit', 'Save Language', ['class' => 'btn btn-primary']) !!}
                @if ( Request::is('*/edit') )
                    <a href="{{route('ch-admin.language.index')}}" class="btn btn-default">Cancel</a>
                @endif
            </div>

        </div>
    </div>
</div>