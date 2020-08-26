@extends('admin.layouts.master')


@section('title', $title)

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>

                <form action="">

                </form>
                <div class="box-tools">
                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input name="s" class="form-control pull-right" placeholder="Search" type="text" value="{{Request::input('s')}}">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body table-responsive no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( ! empty( $orders ) )
                        @foreach ( $orders as $order )
                        <tr>
                            <th scope="row">
                                <a href="{{route('ch-admin.order.show', [$order->id])}}">#{{ $order->id }}</a> - <a href="{{route('ch-admin.order.messages', [$order->id])}}">Messages</a>
                            </th>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->diffForHumans() ?? $order->created_at }}</td>
                            <td>{!! $order->totalFormatted() !!}</td>
                            <td>
                                <form method="post" action="{{route('ch-admin.order.destroy', $order->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else 
                    <tr>
                        <td colspan="4">No Orders found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">
                {{$orders->links()}}
            </div>

    </div>
</div>
</div>
@endsection
