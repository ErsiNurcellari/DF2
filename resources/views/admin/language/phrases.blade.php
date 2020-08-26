@extends('admin.layouts.master')


@section('title', 'Languages')

@section('content')
    <nav class="navbar navbar-default">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @foreach($groups as $key => $group)
                        <li {!! (($key == $active_group) || ($key == '*' && $active_group == 'general')) ? 'class="active"' : '' !!}>
                            <a href="{{route('ch-admin.phrases.edit', [$language->id, $key == '*' ? 'general' : $key])}}">{{$group}}</a>
                        </li>
                    @endforeach
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


    <form action="{{route('ch-admin.phrases.update', [$language->id, $active_group])}}" method="post">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary pull-right btn-sm">Save</button>
        <h3 class="sub-settings">{{$groups[$active_group]}} Phrases</h3>
        <hr>
        @forelse($phrases as $phrase)
            <div class="form-group row">
                <label for="phrase[]" class="col-sm-2 control-label">{{$phrase->key}}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="phrases[{{$phrase->key}}]"
                              name="phrases[{{$phrase->key}}]">{{$phrase->value}}</textarea>
                    @if (strpos($phrase->value, ':') !== false)
                        <p class="help-block text-muted"><strong>Note:</strong> Don't change or modify the words starting with colon (<code>:</code>)</p>
                    @endif
                </div>
            </div>
        @empty
            <p>No Phrases Found.</p>
        @endforelse

        @if($phrases->count() > 0)
            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        @endif
    </form>
@endsection
