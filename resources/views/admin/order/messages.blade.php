@extends('admin.layouts.master')


@section('title', $title)

@section('content')

    <form class="form-horizontal" action="{{route('ch-admin.order.update', $order->id)}}" method="post">
        <div class="row">


            <div class="col-md-8">
                <section class="invoice mb-20">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-cart-plus"></i> <a href="{{route('ch-admin.order.show', [$order->id])}}">Order #{{$order->id}}</a> Messages
                                <small class="pull-right">Date Time: {{$order->created_at}}</small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                </section>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Attach files</h3>
                    </div>
                    <div class="boxy-body">

                        <div class="uploader"
                             data-media-config='{"key": "attachments", "container": ".order-files", "disk": "local"}'
                             data-files="@if (isset($order) && $order->hasMedia('attachments')){{$attachments}}@endif">
                            @include('admin.media.upload')

                            <div class="order-files"></div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Send message to Customer</h3>
                    </div>
                    <div class="box-body">

                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="{{ $errors->has('content') ? ' has-error' : '' }}">

                            @if ($errors->has('content'))
                                <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                            @endif
                            <label for="content">Message</label>
                            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                        </div>
                        <div class="" style="margin-top:20px;">
                            <input type="submit" name="post_message" value="Add Reply" class="btn btn-primary">
                        </div>

                    </div>
                </div>


                @forelse ( $order->messages as $message )

                    <div class="panel panel-default" id="message-{{$message->id}}">
                        <div class="panel-heading">
                            <span class="pull-right">{{$message->created_at->diffForHumans()}}</span>
                            <a href="{{site_url('ch-admin/user/'. $message->user->id . '/edit')}}">{{$message->user->name}}</a>
                        </div>

                        <div class="panel-body">{{$message->content}}</div>
                    </div>

                @empty

                @endforelse

            </div>
        </div>
    </form>
@endsection


@push('ch_footer')
    <script src="{{ asset('assets/backend/js/vendors/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/media.js') }}"></script>
@endpush
