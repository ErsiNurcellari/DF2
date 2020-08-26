@extends('admin.layouts.master')

@section('title', $title)

@section('content')

    <div class="row">
        {!! Form::model( $service, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.service.update', $service->id ] ] ) !!}

        @include('admin.service.partials.form', ['submitLabel' => 'Update'])

        {!! Form::close() !!}
    </div>

@endsection
