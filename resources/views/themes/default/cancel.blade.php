@extends('themes.default.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-8 col-md-offset-2">
                @if(isset($failed))
                    <h1>@lang('order.failed')</h1>
                @else
                    <h1>@lang('order.cancelled')</h1>
                @endif
                <p class="lead">@lang('order.place_more_orders')</p>
                <p><a class="btn btn-primary" href="{{site_url('/')}}">@lang('btn_browse_services')</a></p>
            </div>
        </div>
    </div>
@endsection
