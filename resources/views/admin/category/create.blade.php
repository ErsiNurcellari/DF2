@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">


    {!! Form::open(['url' => 'ch-admin/category', 'class' => 'product-form']) !!}

        @include('admin.category.partials.form')

    {!! Form::close() !!}


    @include('admin.category.listing')

</div>

@endsection
