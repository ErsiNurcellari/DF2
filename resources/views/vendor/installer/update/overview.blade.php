@extends('vendor.installer.layouts.master-update')

@section('title', 'Update Overview')
@section('container')
    <p class="paragraph text-center">{{ 'There are '.$numberOfUpdatesPending.' updates.' }}</p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::database') }}" class="button">Install Updates</a>
    </div>
@stop
