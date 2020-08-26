@extends('themes.default.app')

@section('content')

    <div class="container">
        <div class="row text-center">
            <div class="col-md-8 col-md-offset-2">
                <div style="padding: 180px 0">
                    <h1>@lang('order.thank_you.heading')</h1>
                    <p class="lead">@lang('order.thank_you.thank_lead')</p>
                    <p><a class="btn btn-primary" href="{{route('ch_order_view', $order->id)}}">@lang('order.thank_you.view_order')</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection
