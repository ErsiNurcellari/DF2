@extends('admin.layouts.master')


@section('title', 'Services')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}} <a class="btn btn-primary" href="{{route('ch-admin.service.create')}}">Add New</a></h3>

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
                        <th>ID</th>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $services as $service )
                    <tr>
                        <th scope="row">{{ $service->id }}</th>
                        <td><a href="{{ route( 'ch-admin.service.edit', [$service->id]) }}">{{ $service->title }}</a> {!! ( $service->status == 'draft' ) ? '<span class="service-status">&mdash; Draft</span>' : '' !!}</td>
                        <td><a href="{{ route( 'ch-admin.service.edit', [$service->id]) }}">Edit</a></td>
                        <td>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['ch-admin.service.destroy', $service->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?');"]) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">
                {{$services->links()}}
            </div>

    </div>
</div>
</div>
@endsection
