@extends('admin.layouts.master')


@section('title', $title)

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}} <a class="btn btn-primary" href="{{route('ch-admin.user.create')}}">Add User</a></h3>

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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Registered</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $users as $user )
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td><a href="{{ route( 'ch-admin.user.edit', [$user->id]) }}">{{ $user->username }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->verified == '1' ? 'Yes' : 'No' }}</td>
                        <td>{{ ( $user->roles->first() !== null ) ? $user->roles->first()->display_name : 'N/A'  }}</td>
                        <td>{{ isset( $user->last_login ) ? $user->last_login->diffForHumans() : 'Never' }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['ch-admin.user.destroy', $user->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this User?');"]) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

            <div class="box-footer clearfix">
                {{$users->links()}}
            </div>

    </div>
</div>
</div>
@endsection
