<div class="col-md-8">

    @include('admin.layouts.errors')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">General Information</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title here']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>


        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Service Price</h3>
        </div>
        <div class="box-body">

            <div class="row" id="simple-price">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Attach Files</h3>
        </div>
        <div class="box-body">
            <p>These files will be available to the customers after the successful order.</p>
            <div class="uploader"
                 data-media-config='{"key": "meta[attachments]", "container": ".service-files", "disk": "local"}'
                 data-files="@if (isset($service) && $service->hasMedia('attachments')){{$attachments}}@endif">
                @include('admin.media.upload')

                <div class="service-files"></div>
            </div>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order form</h3>
        </div>
        <div class="box-body">

            <div class="row" id="simple-price">
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('form_id', 'Order Form:') !!}
                        {!! Form::select('form_id', $forms, null, ['class' => 'form-control', 'placeholder' => 'Select a Form']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Meta Information</h3>
        </div>
        <div class="box-body">


            <!--  Instructions to Employers -->
            <div class="form-group">
                {!! Form::label('meta', 'Guideline:') !!}
                {!! Form::textarea('meta[guideline]', isset($service) ? $service->getMeta('guideline') : null, ['class' => 'form-control', 'id' => 'guideline']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('delivery_time', 'Delivery Time:') !!}
                {!! Form::text('meta[delivery_time]', isset($service) ? $service->getMeta('delivery_time') : null, ['class' => 'form-control', 'placeholder' => '3 Days']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('revisions', 'Revisions:') !!}
                {!! Form::text('meta[revisions]', isset($service) ? $service->getMeta('revisions') : null, ['class' => 'form-control', 'placeholder' => '5']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('demo_url', 'Demo URL:') !!}
                {!! Form::input('url', 'meta[demo_url]', isset($service) ? $service->getMeta('demo_url') : null, ['class' => 'form-control']) !!}
            </div>
        </div>


    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">What's included</h3>
        </div>
        <div class="box-body">
            <p>What will be included with service in regular price.</p>
            <div class="meta-wrapper row">
                @if(Route::currentRouteName() === 'ch-admin.service.edit')
                    @if (isset($service->tasks) && $service->tasks->count() > 0)
                        @foreach( $service->tasks as $task )
                            <div class="toclone">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {!! Form::label('included_value', 'Task:') !!}
                                        {!! Form::input('text', 'tasks[]', $task->name, ['class' => 'form-control', 'placeholder' => 'Plugins installation']) !!}
                                    </div>
                                </div>
                                <div class="col-md-1 clone"><a type="button" class="btn btn-xs btn-primary"><i
                                                class="fa fa-plus"></i></a></div>
                                <div class="col-md-1 delete"><a type="button" class="delete btn btn-xs btn-danger"><i
                                                class="fa fa-minus"></i></a></div>
                            </div>
                        @endforeach
                    @endif

                        <div class="toclone">
                            <div class="col-md-10">
                                <div class="form-group">
                                    {!! Form::label('included_value', 'Task:') !!}
                                    {!! Form::input('text', 'tasks[]', '', ['class' => 'form-control', 'placeholder' => 'Plugins installation']) !!}
                                </div>
                            </div>
                            <div class="col-md-1 clone"><a type="button" class="btn btn-xs btn-primary"><i
                                            class="fa fa-plus"></i></a></div>
                            <div class="col-md-1 delete"><a type="button" class="delete btn btn-xs btn-danger"><i
                                            class="fa fa-minus"></i></a></div>
                        </div>

                @else
                    <div class="toclone">
                        <div class="col-md-10">
                            <div class="form-group">
                                {!! Form::label('included_value', 'Task:') !!}
                                {!! Form::input('text', 'tasks[]', null, ['class' => 'form-control', 'placeholder' => 'Plugins installation']) !!}
                            </div>
                        </div>
                        <div class="col-md-1 clone"><a type="button" class="btn btn-xs btn-primary"><i
                                        class="fa fa-plus"></i></a></div>
                        <div class="col-md-1 delete"><a type="button" class="delete btn btn-xs btn-danger"><i
                                        class="fa fa-minus"></i></a></div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Addons</h3>
        </div>
        <div class="box-body">
            <div class="addon-wrapper">
                @if(Route::currentRouteName() === 'ch-admin.service.edit' && isset($service->addons) && count(($service->addons)) > 0)

                    @foreach( $service->addons as $addon )
                        <div class="toclone row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Form::label('addon_name', 'Addon name:') !!}
                                    {!! Form::input('text', 'addons[name][]', $addon->name, ['class' => 'form-control', 'placeholder' => 'Start Typing..', 'data-addon' => 'true']) !!}
                                    {!! Form::input('hidden', 'addons[id][]', $addon->id, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Form::label('addon_price', 'Price:') !!}
                                    {!! Form::input('text', 'addons[price][]', $addon->pivot->price, ['class' => 'form-control', 'placeholder' => '5.00']) !!}
                                </div>
                            </div>
                            <div class="col-md-1 clone"><a type="button" class="btn btn-xs btn-primary"><i
                                            class="fa fa-plus"></i></a></div>
                            <div class="col-md-1 delete"><a type="button" class="delete btn btn-xs btn-danger"><i
                                            class="fa fa-minus"></i></a></div>
                        </div>
                    @endforeach

                @else
                    <div class="toclone row">
                        <div class="col-md-5">
                            <div class="form-group">
                                {!! Form::label('addon_name', 'Addon name:') !!}
                                {!! Form::input('text', 'addons[name][]', null, ['class' => 'form-control', 'placeholder' => 'Start Typing..', 'data-addon' => 'true']) !!}
                                {!! Form::input('hidden', 'addons[id][]', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                {!! Form::label('addon_price', 'Price:') !!}
                                {!! Form::input('text', 'addons[price][]', null, ['class' => 'form-control', 'placeholder' => '5.00']) !!}
                            </div>
                        </div>
                        <div class="col-md-1 clone"><a type="button" class="btn btn-xs btn-primary"><i
                                        class="fa fa-plus"></i></a></div>
                        <div class="col-md-1 delete"><a type="button" class="delete btn btn-xs btn-danger"><i
                                        class="fa fa-minus"></i></a></div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Gallery</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group uploader"
                 data-media-config='{"key": "meta[service_images]", "container": ".service-gallery-images"}'
                 data-files="@if (isset($service) && $service->hasMedia('gallery')){{$gallery}}@endif">
                @include('admin.media.upload')

                <div class="service-gallery-images"></div>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">SEO Settings (optional)</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('meta[seo_title]', 'Title:') !!}
                {!! Form::text('meta[seo_title]', isset($service) ? $service->getMeta('seo_title') : null, ['class' => 'form-control', 'placeholder' => 'Enter title here']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta[seo_description]', 'Description:') !!}
                {!! Form::textarea('meta[seo_description]', isset($service) ? $service->getMeta('seo_description') : null, ['class' => 'form-control', 'rows' => 3]) !!}
            </div>


        </div>
    </div>

</div>

<div class="col-md-4">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Publish</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::input('submit', 'save', 'Save draft', ['class' => 'btn btn-default']) !!}
                {!! Form::input('submit', 'publish', $submitLabel, ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Categories</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::select('term_list[]', $categories, null, ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
    </div>

</div>

@section('ch_header')
<script src="{{asset('assets/backend/js/vendors/ckeditor/ckeditor.js')}}"></script>
@endsection

@push('ch_footer')
    <script src="{{ asset('assets/backend/js/vendors/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/media.js') }}"></script>
    <script>
        $(function () {
            var availableAddons = {!! $addons !!};

            $('input[data-addon]').autocomplete({
                source: availableAddons,
                select: function (event, ui) {
                    var label_input = $(event.target);
                    label_input.val(ui.item.label);
                    label_input.next('input').val(ui.item.value);
                    return false;
                }
            });

            $(document).on('DOMNodeInserted', function () {
                $('input[data-addon]').autocomplete({
                    source: availableAddons,
                    select: function (event, ui) {
                        var label_input = $(event.target);
                        label_input.val(ui.item.label);
                        label_input.next('input').val(ui.item.value);
                        return false;
                    }
                });
            });
        });

        <p><label for="description">Description:</label> <textarea cols="60" id="description"  name="description" rows="40">
</textarea></p>
<script>
    CKEDITOR.replace('description');
</script>
    </script>
@endpush

