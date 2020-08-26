@extends('admin.layouts.master')


@section('title', 'Forms')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}} <a class="btn btn-primary" href="{{route('ch-admin.form.create')}}">Add New</a></h3>

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
                    @foreach ( $forms as $form )
                    <tr>
                        <th scope="row">{{ $form->id }}</th>
                        <td><a href="{{ route( 'ch-admin.form.edit', [$form->id]) }}">{{ $form->name }}</a></td>
                        <td><a href="{{ route( 'ch-admin.form.edit', [$form->id]) }}">Edit</a></td>
                        <td>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['ch-admin.form.destroy', $form->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?');"]) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">
                {{$forms->links()}}
            </div>

    </div>
</div>
</div>
@endsection
