@extends('admin.layouts.master')

@section('title', $title)

@section('content')

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$total_completed}}</h3>

                    <p>Completed Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('ch-admin.order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$total_processing}}</h3>

                    <p>Processing Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-code-working"></i>
                </div>
                <a href="{{route('ch-admin.order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$total_pending}}</h3>

                    <p>Pending Payment Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-load-c"></i>
                </div>
                <a href="{{route('ch-admin.order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$total_cancelled}}</h3>
                    <p>Cancelled Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-minus-circled"></i>
                </div>
                <a href="{{route('ch-admin.order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>


    <div class="row">

        <div class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    {{--<li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>--}}

                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales Last 30 days</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"></div>
                    <div class="chart tab-pane" id="sales-chart"></div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->
        </div>

    </div>


@endsection

@push('ch_footer')
    <script src="{{asset('assets/backend/js/vendors/raphael.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/vendors/morris.min.js')}}"></script>

    <script>
        var area = new Morris.Area({
            element   : 'revenue-chart',
            resize    : true,
            xkey      : 'y',
            ykeys     : ['sales'],
            labels    : ['Sale'],
            lineColors: ['#a0d0e0'],
            hideHover : 'auto',
            data      : {!! $sales !!}
        });
    </script>

@endpush