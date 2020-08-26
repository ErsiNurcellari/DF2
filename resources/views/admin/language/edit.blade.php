@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">


    {!! Form::model($language, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.language.update', $language->id ] ]) !!}

        @include('admin.language.partials.form')

    {!! Form::close() !!}

</div>

@endsection
