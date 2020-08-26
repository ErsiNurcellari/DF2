@extends('themes.default.app')

@section('content')
    <div class="container archive">
        <div class="row">

            @isset($term)
                <div class="col-md-12">
                    <h1>{{$term->name}}</h1>
                    <hr>
                </div>
            @endisset

            @isset($q)
                @if($services->total())
                    <div class="col-md-12 mb-5">
                        <h1>@lang('results_found', ['count' => $services->total(), 'q' => $q])</h1>
                        <hr>
                    </div>
                @else
                    <div class="col-md-12 text-center" style="padding: 180px 0;">
                        <h1>@lang('no_results_found')</h1>
                        <p><a class="btn btn-primary" href="{{site_url('/')}}">@lang('btn_browse_services')</a></p>
                    </div>
                @endif
            @endisset

            @forelse( $services as $service )

                <div class="col-md-3 col-sm-6">
                    <div class="service-box">
                        <figure>
                            <a href="{{route('ch_service_single', [$service->slug])}}">
                                @if($service->hasMedia('gallery'))
                                    <img src="{{$service->firstMedia('gallery')->getUrl('medium')}}" class="img-responsive" alt="{{$service->title}}">
                                @else
                                    <img src="{{get_placeholder_img()}}" class="img-responsive" alt="{{$service->title}}">
                                @endif
                            </a>
                        </figure>
                        <div class="service-content">
                            <h3><a href="{{route('ch_service_single', [$service->slug])}}">{{$service->title}}</a></h3>
                            <div class="footer clearfix">
                                <div class="pull-left view-details">
                                    <form action="{{route('ch_cart_save')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="item_id" value="{{$service->id}}">
                                        <input class="btn btn-primary btn-xs" type="submit" name="service_order" value="@lang('btn_order_now')">
                                    </form>
                                </div>
                                <p class="price pull-left">@lang('starting_at') <span>{!! $service->displayPrice !!}</span></p>
                            </div>

                        </div>
                    </div>
                </div>

            @empty

                    @isset($term)
                        <div class="col-md-12" style="min-height: 400px;">
                            <p>@lang('no_services_found')</p>
                            <p><a class="btn btn-primary" href="{{site_url('/')}}">@lang('btn_browse_services')</a></p>
                        </div>
                    @endisset

            @endforelse


            <div class="col-md-12 text-center">
                {{$services->links()}}
            </div>

        </div>
    </div>
@endsection
