@extends('admin.layouts.master')

@section('title', $title)

@section('content')

    <div class="row">


        {!! Form::open(['url' => 'ch-admin/service', 'class' => 'service-form']) !!}

        @include('admin.service.partials.form', ['submitLabel' => 'Publish'])

        {!! Form::close() !!}


    </div>

@endsection
