@extends('admin.layouts.master')

@section('title', $title)

@section('content')

<div class="row">
    {!! Form::model( $user, [ 'method' => 'PATCH', 'route' => [ 'ch-admin.user.update', $user->id ] ] ) !!}

        @include('admin.user.partials.form', ['submitLabel' => 'Update'])

    {!! Form::close() !!}
</div>

@endsection
