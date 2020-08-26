@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">


    {!! Form::open(['url' => 'ch-admin/form', 'class' => 'form']) !!}

    @include('admin.form.partials.form', ['submitLabel' => 'Publish'])

    {!! Form::close() !!}

    @include('admin.form.partials.builder')

</div>

@endsection
