@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">

    {!! Form::model( $form, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.form.update', $form->id ], 'class' => 'form' ] ) !!}

        @include('admin.form.partials.form', ['submitLabel' => 'Update'])

    {!! Form::close() !!}

    @include('admin.form.partials.builder')

</div>

@endsection
