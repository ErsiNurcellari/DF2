@extends('themes.default.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>@lang("menu.$heading")</h1>
                {!! $content !!}
            </div>
        </div>
    </div>

@endsection
