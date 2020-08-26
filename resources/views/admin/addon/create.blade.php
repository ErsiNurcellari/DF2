@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">


    {!! Form::open(['url' => 'ch-admin/addon', 'class' => 'addon-form']) !!}

        @include('admin.addon.partials.form')

    {!! Form::close() !!}


    @include('admin.addon.listing')

</div>

@endsection
