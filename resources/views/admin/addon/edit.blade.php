@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">


    {!! Form::model($addon, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.addon.update', $addon->id ] ]) !!}

        @include('admin.addon.partials.form')

    {!! Form::close() !!}

</div>

@endsection
