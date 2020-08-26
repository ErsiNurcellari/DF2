@extends('themes.default.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-3">
                @include('themes.default.account.nav')
            </div>

            <div class="col-md-9 col-sm-9">
                <h1>Order#{{$order->id}}</h1>

                <div class="panel panel-default">
                    <div class="panel-heading">@lang('order.order_details')</div>
                    <div class="panel-body">

                        <div class="row"
                             style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;">
                            <div class="col-md-2 col-sm-3"><strong>@lang('order.status')</strong></div>
                            <div class="col-md-4 col-sm-3">{{$order->status_text}}</div>
                            <div class="col-md-2 col-sm-3"><strong>@lang('order.submitted')</strong></div>
                            <div class="col-md-4 col-sm-3">{{$order->created_at->diffForHumans()}}</div>
                        </div>

                        <div class="row" style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;">

                            <div class="col-md-2 col-sm-3"><strong>@lang('order.service_name')</strong></div>
                            <div class="col-md-4 col-sm-3">{{$order->items->first()->name()}}</div>
                            <div class="col-md-2 col-sm-3"><strong>@lang('order.addons')</strong></div>
                            <div class="col-md-4 col-sm-3">
                                @if( $order->items->where('item_type', 'addon')->count() > 0 )
                                    @foreach ( $order->items->where('item_type', 'addon') as $addon )
                                    {{ $addon->name() }}<br>
                                    @endforeach
                                @endif

                                @if ( $order->addons && count($order->addons) > 0)
                                    @foreach ( $order->addons as $addon )
                                        {{ $addon['name'] or "" }}<br>
                                    @endforeach
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-3"><strong></strong></div>
                            <div class="col-md-4 col-sm-3"></div>
                            <div class="col-md-2 col-sm-3"><strong>@lang('order.total')</strong></div>
                            <div class="col-md-4 col-sm-3">{!! $order->TotalFormatted() !!}</div>
                        </div>

                        @if($order->hasMedia('downloads') && ($order->status != 'cancelled' || $order->status != 'refunded'))
                            <div class="row" style="border-top: 1px solid #EEE; padding-top: 12px; margin-top: 12px;">
                                <div class="col-md-3 col-sm-3"><strong>@lang('order.downloads')</strong></div>
                                <div class="col-md-9 col-sm-9">
                                    @foreach($order->getMedia('downloads') as $media)
                                        - <a href="{{route('download_attachment', $media->token)}}"><strong>{{$media->Basename}}</strong></a>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                @if($order->hasMedia('attachments'))
                    <div class="panel panel-default">
                        <div class="panel-heading">@lang('order.attachments.attachments')</div>
                        <div class="panel-body">
                            @foreach($order->getMedia('attachments') as $media)
                                @if(!isset($media->token))
                                    @continue;
                                @endif
                                <div class="row" @if(!$loop->last) style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;"@endif>
                                    <div class="col-md-12"><a href="{{route('download_attachment', $media->token)}}"><strong>{{$media->Basename}}</strong></a> (@lang('order.attachments.submitted') {{$media->created_at->diffForHumans()}})</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($order->customFields->count())
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('order.submitted_info')</div>
                    <div class="panel-body">
                        @foreach($order->customFields as $row)
                            @if($row->type == 'file' && !isset($row->file->token))
                                @continue
                            @endif
                            <div class="row"
                                 @if(!$loop->last)
                                 style="border-bottom: 1px solid #EEE; padding-bottom: 12px; margin-bottom: 12px;"
                                 @endif
                            >
                                <div class="col-md-4 col-sm-4"><strong>{{$row->label}}</strong></div>
                                <div class="col-md-8 col-sm-8">{!! $row->type == 'file' ? '<a href="'.route('download_attachment', $row->file->token).'">'.$row->file->filename.'</a>' : $row->value !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @hook('ch_view_order_after_details')

                @if($order->status != 'cancelled')
                    @if($order->status != 'completed')
                        <form action="" method="POST">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                                @endif
                                <label for="content">@lang('order.message')</label>
                                <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="post_message" value="@lang('order.add_reply')" class="btn btn-primary">
                            </div>
                        </form>

                        @forelse ( $order->messages as $message )

                            <div class="panel panel-default" id="message-{{$message->id}}">
                                <div class="panel-heading">
                                    <span class="pull-right">{{$message->created_at->diffForHumans()}}</span>
                                    {{$message->user->username}}
                                </div>

                                <div class="panel-body">{{$message->content}}</div>
                            </div>

                        @empty

                        @endforelse

                    @else

                        @if ( $order->feedback(\Auth::user()->id) )

                            <h3>@lang('order.your_feedback'):</h3>

                            <div class="form-group">
                                <p><strong>@lang('order.your_rating')</strong></p>
                                <select class="posted" id="rating">
                                    @for( $x = 1; $x <= 5; $x++ )
                                        <option value="{{$x}} "{{$order->feedback(\Auth::user()->id)->rating == $x ? 'SELECTED' : ''}}>{{$x}}</option>
                                    @endfor
                                </select>
                            </div>

                            <p><strong>@lang('order.your_comments'):</strong></p>
                            <p>{{$order->feedback(\Auth::user()->id)->content}}</p>


                        @else
                            <h3>@lang('order.provide_feedback')</h3>

                            <form action="" method="POST">
                                {{csrf_field()}}
                                {{method_field('PUT')}}

                                <div class="form-group">
                                    <label for="rating">@lang('order.your_rating')</label>
                                    <select id="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                                    @endif
                                    <label for="content">@lang('order.comments')</label>
                                    <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="post_feedback" value="@lang('order.submit_feedback')"
                                           class="btn btn-primary">
                                </div>
                            </form>
                        @endif



                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection
