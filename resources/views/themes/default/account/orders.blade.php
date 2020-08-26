@extends('themes.default.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-3 col-sm-3">
            @include('themes.default.account.nav')
        </div>
        
        <div class="col-md-9 col-sm-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('order.orders')</div>

                <div class="panel-body">
                    
                    
                    <div class="table-responsive">
                        <table class='table table-bordered'>
                            <thead>
                            <tr>
                                <th>@lang('order.order_id')</th>
                                <th>@lang('order.service_name')</th>
                                <th>@lang('order.status')</th>
                                <th>@lang('order.submitted')</th>
                                <th>@lang('order.last_reply')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ( $orders as $order )
                                <tr>
                                    <td><a href="{{route('ch_order_view', [$order->id])}}">#{{$order->id}}</a></td>
                                    <td>{{$order->service}}</td>
                                    <td>{{$order->status_text}}</td>
                                    <td>{{$order->created_at->diffForHumans()}}</td>
                                    @if ( $order->status != 'cancelled' )
                                        <td><a href="{{route('ch_order_view', [$order->id])}}">{{ ( count( $order->messages ) > 0 ) ? $order->messages->last()->user->username : trans('order.none_add_reply')}}</a></td>
                                    @else
                                        <td><a href="{{route('ch_order_view', [$order->id])}}">@lang('order.view_details')</a></td>
                                    @endif
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="5" class="text-center"><strong>@lang('order.no_orders')</strong></td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                    </div>


                    <div class="text-center">
                        {{$orders->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
