@extends('themes.default.app')

@section('content')

<div class="container" id="cart">
    <div class="row">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('ch_order_save') }}" method="post" id="payment-form">
            {{csrf_field()}}
            {{method_field('POST')}}
            <div class="col-md-8">
                <div class="box-white order-page">

                    <h3 class="page-title">@lang('cart.order_details')</h3>

                    <div class="service-box clearfix">
                        <figure class="pull-left">
                            <a href="{{route('ch_service_single', [$service->slug])}}">
                                @if($service->hasMedia('gallery'))
                                    <img src="{{$service->firstMedia('gallery')->getUrl('medium')}}" class="img-responsive" alt="{{$service->title}}">
                                @else
                                    <img src="{{get_placeholder_img()}}" class="img-responsive" alt="{{$service->title}}">
                                @endif
                            </a>
                        </figure>

                        <div class="service-content">
                            <h3><a href="{{route('ch_service_single', [$service->slug])}}">{{$service->title}}</a>
                            </h3>

                            <ul class="included">

                                @if( $service->hasMeta('delivery_time') || $service->hasMeta('revisions') )
                                    <li class="delivery"><i class="fa fa-undo"></i>
                                        @if($service->hasMeta('delivery_time'))
                                            {{$service->getMeta('delivery_time')}}
                                        @endif
                                        @if($service->hasMeta('revisions'))
                                            with {{$service->getMeta('revisions')}} Revisions
                                        @endif
                                    </li>
                                @endif

                                @forelse ( $service->tasks as $task )
                                    <li><i class="fa fa-check"></i> {{$task->name}}</li>
                                @endforeach
                            </ul>

                        </div>
                    </div>


                    <h3>@lang('cart.addons')</h3>
                    @forelse( $service->addons as $addon )
                    <div class="checkbox addon">
                        <label>
                            <span class="pull-right">{!! ch_format_price($addon->pivot->price) !!}</span>
                            <input type="checkbox" name="addons[]" value="{{$addon->id}}" v-model="cartData.addons">
                                   <span class='addon-name'>{{$addon->name}}</span>
                        </label>
                    </div>
                    @empty
                    <p>@lang('cart.no_addons')</p>
                    @endforelse


                </div>

                @if(Auth::user())
            @if($service->form_id)
                <div class="box-white">
                    @if( $service->hasMeta('guideline') )
                        <h3 class="box-heading">@lang('cart.provide_info'):</h3>
                        <p>@lang('cart.provide_info_desc')</p>
                        {!! nl2br( $service->getMeta('guideline') ) !!}
                    @endif
                        <br><br>
                        {!! $service->form->content ?? '' !!}

                     @hook('ch_checkout_meta_fields')

                </div>
            @endif



                <div class="box-white order-billing">
                    <h3 class="box-heading">@lang('account.profile.billing_info'):</h3>

                    <div class="row">
                        
                        <div class="form-group clearfix{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">@lang('account.profile.first_name')</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" required class="form-control" name="first_name" value="{{ !empty(old('first_name')) ? old('first_name') : Auth::user()->first_name }}">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group clearfix{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">@lang('account.profile.last_name')</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" required class="form-control" name="last_name" value="{{ !empty(old('last_name')) ? old('last_name') : Auth::user()->last_name }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group clearfix{{ $errors->has('usermeta.billing_address') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_address]" class="col-md-4 control-label">@lang('account.profile.address')</label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_address]" required type="text" class="form-control" name="usermeta[billing_address]" value="{{ !empty(old('usermeta.billing_address')) ? old('usermeta.billing_address') : Auth::user()->billing_address }}">

                                @if ($errors->has('usermeta.billing_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('usermeta.billing_address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group clearfix{{ $errors->has('usermeta.billing_city') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_city]" class="col-md-4 control-label">@lang('account.profile.city')</label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_city]" required type="text" class="form-control" name="usermeta[billing_city]" value="{{ !empty(old('usermeta.billing_city')) ? old('usermeta.billing_city') : Auth::user()->billing_city }}">

                                @if ($errors->has('usermeta.billing_city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('usermeta.billing_city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group clearfix{{ $errors->has('usermeta.billing_zip') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_zip]" class="col-md-4 control-label">@lang('account.profile.zip_code')</label>

                            <div class="col-md-6">
                                <input id="usermeta[billing_zip]" required type="text" class="form-control" name="usermeta[billing_zip]" value="{{ !empty(old('usermeta.billing_zip')) ? old('usermeta.billing_zip') : Auth::user()->billing_zip }}">

                                @if ($errors->has('usermeta.billing_zip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('usermeta.billing_zip') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group clearfix{{ $errors->has('usermeta.billing_country') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_country]" class="col-md-4 control-label">@lang('account.profile.country')</label>

                            <div class="col-md-6">
                                <select id="usermeta[billing_country]" required v-model="cartData.billing_country" type="text" class="form-control" name="usermeta[billing_country]" v-on:change="updateStates">
                                    <option value="0">@lang('account.profile.select_country')</option>
                                    <option v-for="country in countries" :value="country.id">@{{country.name}}</option>
                                </select>

                                @if ($errors->has('usermeta.billing_country'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('usermeta.billing_country') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group clearfix{{ $errors->has('usermeta.billing_state') ? ' has-error' : '' }}">
                            <label for="usermeta[billing_state]" class="col-md-4 control-label">@lang('account.profile.state')</label>

                            <div class="col-md-6 user-state">
                                <div class='state-container'>
                                    <select id="usermeta[billing_state]" required v-model="cartData.billing_state" type="text" class="form-control" name="usermeta[billing_state]">

                                        <option value="0">@lang('account.profile.select_state')</option>
                                        <option v-for="state in states" :value="state.id">@{{state.name}}</option>

                                    </select>
                                </div>


                                @if ($errors->has('usermeta.billing_state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('usermeta.billing_state') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            </div><!-- /.col-md-8 -->


            <div class="col-md-4">
                <div class="summary-container" data-sticky="true">
                    @include('core.order.summary')
                </div>
            </div>
        </form>

    </div>


</div>
<script id="states-template" type="text/x-handlebars-template">
    <select id="usermeta[billing_state]" v-model="cartData.billing_state" class="form-control" name="usermeta[billing_state]">
        <option value="">@lang('account.profile.select_state')</option>
        @{{#each this}}
            <option value="@{{ @key }}">@{{this}}</option>
        @{{/each}}    
    </select>
</script>
@endsection

@push('ch_footer')

    @php
        $addon_ids = Cart::content()->filter(function($item){
            return $item->model instanceof \App\Models\Addon;
        })->pluck('id');

    @endphp

    <script src="//js.stripe.com/v3/"></script>

    <script src="{{ asset('assets/backend/js/vendors/dropzone.min.js') }}"></script>
    <script>
        var upload_url = '{{site_url('cart/upload')}}';
        var service_id = '{{$service->form_id}}';
        var countries = {!! $countries !!};
        var states = {!! $states !!};
        var addons = {!! $addon_ids !!};
        var billing_country = '{{$user_country}}';
        var billing_state = '{{$user_state}}';
        var cart_url = '{{site_url('cart')}}';
    </script>
    <script src="{{ asset('assets/themes/default/js/vue.min.js') }}"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/themes/default/js/cart.js') }}"></script>
@endpush