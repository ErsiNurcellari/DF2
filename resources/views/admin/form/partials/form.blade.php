<div class="col-md-12">

    @include('admin.layouts.errors')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order Form</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('name', 'Form Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name here']) !!}
            </div>

            {!! Form::hidden('content', null, ['class' => 'form-control content']) !!}
            {!! Form::hidden('raw_content', null, ['class' => 'form-control raw_content']) !!}

        </div>
    </div>


</div>
@push('ch_footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{asset('assets/backend/js/vendors/form-builder.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/vendors/form-render.min.js')}}"></script>
    <script>
        (function ($) {
            var formData = {!! $form->raw_content ?? '[];' !!}
            var options = {
                    disabledAttrs: [
                        'access'
                    ],
                    disableFields: ['autocomplete'],
                    disabledActionButtons: ['data'],
                    typeUserDisabledAttrs:
                        {
                            file: [
                                'className',
                                'placeholder',
                                'subtype'
                            ]
                        },
                    typeUserAttrs: {
                        file: {
                            allowed_types: {
                                label: 'Allowed file types',
                                value: 'jpg, png, gif'
                            },
                            allowed_size: {
                                label: 'Allowed file size (MB)',
                                min: 1,
                                value: 1,
                            },

                            max_files: {
                                label: 'Max Files allowed',
                                min: 1,
                                value: 1,
                            },
                        }
                    }
                };

            var formBuilder = $("#form-editor").formBuilder(options);

            $(document).on('click', '.save-template', function (e) {
                var renderedForm = $('<div>');
                var formJson = formBuilder.actions.getData('json');

                renderedForm.formRender({
                    dataType: 'json',
                    formData: formJson
                });

                var markup = $(renderedForm.html());

                markup.find('.formbuilder-file.form-group').each(function(){

                    var json = JSON.parse(formJson);
                    var inputName = $(this).find('input[type=file]').attr('name');

                    var fieldProp = json.filter(function (row) {
                        return row.name == inputName;
                    });

                    $(this).attr('data-prop', JSON.stringify(fieldProp[0]));
                    $(this).find('input[type=file]').remove();
                    $(this).append('<div class="dropzone"></div>');
                });

                markup.find('input, textarea, select').each(function(){
                    var old = $(this).attr('name');

                    if (typeof old !== typeof undefined && old !== false) {
                        if (old.indexOf('[]') === -1) {
                            $(this).attr('name', 'form_data['+old+']');
                        } else {
                            $(this).attr('name', 'form_data['+old.replace('[]', '')+'][]');
                        }

                    }
                });

                $('input.content').val(markup.html());
                $('input.raw_content').val(formBuilder.actions.getData('json'));

                $(document).find('form.form').submit();
            });

            formBuilder.promise.then(function(fb){
                fb.actions.setData(formData);
            });

        })(jQuery);
    </script>
@endpush