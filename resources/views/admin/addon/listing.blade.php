<div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Addons</h3>

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
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $addons as $addon )
                    <tr>
                        <th scope="row">{{ $addon->id }}</th>
                        <td><a href="{{ route( 'ch-admin.addon.edit', $addon->id ) }}">{{ $addon->name }}</a></td>
                        <td>{{$addon->description}}</td>
                        <td><a href="{{ action( 'Admin\AdminAddonController@edit', $addon->id ) }}">Edit</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['ch-admin.addon.destroy', $addon->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?');"]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class="box-footer clearfix">
            {{$addons ?? ''->setPath('addon')->links()}}
        </div>

    </div>

</div>