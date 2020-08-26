@extends('themes.default.app')

@section('content')
    <div class="container">
        <div class="row service-single">


            <div class="col-md-8 col-sm-7">
                <div class="service-box">
                    <h1 class="page-title">{{$service->title}}</h1>

                    @if ($service->hasMedia('gallery'))

                        @if($service->getMedia('gallery')->count() > 1)

                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">

                                    @foreach($service->getMedia('gallery') as $gallery)

                                        <div class="item @if ($loop->first) active @endif">
                                            <img src="{{$gallery->getUrl()}}" alt="">
                                        </div>

                                    @endforeach

                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button"
                                   data-slide="prev">
                                    <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button"
                                   data-slide="next">
                                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        @else
                            <img src="{{$service->getMedia('gallery')->first()->getUrl()}}" class="img-responsive" alt="">
                        @endif
                    @endif

                    @if( $service->hasMeta('demo_url') && $service->getMeta('demo_url') != '' )
                        <p class="text-center demo-link"><a href="{{ $service->getMeta('demo_url') }}" target="_blank"
                                                            class="btn btn-default">@lang('service_detail.view_demo')</a>
                        </p>
                    @endif


                    <div class="service-content">
                        <h3 class="sub-heading">@lang('service_detail.description'):</h3>
                        {!! $service->description !!}


                        @if( $service->hasMeta('guideline') )
                            <hr>
                            <h3>@lang('service_detail.guideline'):</h3>
                            {!! nl2br( $service->getMeta('guideline') ) !!}
                        @endif
                    </div>


                </div>
            </div>

            <div class="col-md-4 col-sm-5">
                <div class="order-box">
                    <div class="heading clearfix">
                        <span class="price">{!! $service->displayPrice !!}</span>
                        <h3>@lang('service_detail.order_detail')</h3>
                    </div>

                    <ul class="included">

                        @if( $service->hasMeta('delivery_time') || $service->hasMeta('revisions') )
                            <li class="delivery"><i class="fa fa-undo"></i>
                                @if($service->hasMeta('delivery_time'))
                                    {{$service->getMeta('delivery_time')}}
                                @endif
                                @if($service->hasMeta('revisions'))
                                    @lang('service_detail.with_revisions', ['rev' => $service->getMeta('revisions')])
                                @endif
                            </li>
                        @endif

                        @forelse ( $service->tasks as $task )
                            <li><i class="fa fa-check"></i> {{$task->name}}</li>
                            @endforeach
                    </ul>


                    <form action="{{route('ch_cart_save')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="item_id" value="{{$service->id}}">
                        <input type="submit" class="btn btn-primary btn-block" name="service_order"
                               value="@lang('service_detail.order_now')">
                        <button type="button" class="btn btn-default btn-block" data-toggle="modal"
                                data-target="#preOrderModal">@lang('service_detail.btn_contact_admin')</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div id="preOrderModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{route('ch_service_pre_order_query')}}" method="post" id="pre-order-form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@lang('service_detail.pre_order_form_title')</h4>
                    </div>
                    <input type="hidden" name="item_id" value="{{$service->id}}">
                    <div class="modal-body">
                        @guest
                            <div class="form-group">
                                <label for="name">@lang('service_detail.pre_order_form_name')</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('service_detail.pre_order_form_email')</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        @endguest
                        <div class="form-group">
                            <label for="message">@lang('service_detail.pre_order_form_message')</label>
                            <textarea name="message" id="message" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">@lang('service_detail.pre_order_btn_close')</button>
                        <button type="submit"
                                class="btn btn-primary">@lang('service_detail.pre_order_btn_submit')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
