Dropzone.autoDiscover = false;

$(document).ready(function () {
    $('.dropzone').each(function () {
        var parent = $(this).parent('.uploader');
        var files = parent.data('files');
        var config = parent.data('media-config');
        var disk = config.disk || 'public';
        var single_upload = config.single_upload;
        var $this = $(this);

        var arrayBrackets = single_upload === undefined ? '[]' : '';
        var maxFiles = config.maxFiles === undefined ? null : config.maxFiles;

        $(this).dropzone({
            init: function () {
                var self = this;

                if (files !== '') {

                    $.each(files, function (k, img) {
                        var mockFile = img;
                        console.log(mockFile);
                        self.emit('addedfile', mockFile);
                        self.emit('complete', mockFile);
                        self.options.thumbnail.call(self, mockFile, img.image_url);
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');

                        $('<input>', {
                            'id': 'media-' + img.id,
                            'type': 'hidden',
                            'name': config.key + arrayBrackets,
                            'value': img.id
                        }).appendTo(config.container);

                    });
                }

                if (single_upload !== undefined) {
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                    });
                }

                //var mockFile = { id: 17, name: "26994181-412917352478918-8290015743080314651-n.jpg", size: 12345, type: 'image/jpeg', url: "http://localhost:8000/uploads/201803/26994181-412917352478918-8290015743080314651-n.jpg" };

                this._updateMaxFilesReachedClass();
            },
            url: base_url + "/ch-admin/media?disk=" + disk,
            thumbnailWidth: 80,
            maxFiles: maxFiles,
            thumbnailHeight: 80,
            parallelUploads: 20,
            timeout: 0,
            maxFilesize: 20971520000,
            previewTemplate: $("#filePreviewTemplate").html(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            sending: function (file, xhr, formData) {
                formData.append('_token', $('meta[name="_token"]').attr('content'));
            },
            success: function (file, response) {
                if (isNaN(parseInt(response))) {
                    return;
                }

                $('<input>', {
                    'id': 'media-' + response,
                    'type': 'hidden',
                    'name': config.key + arrayBrackets,
                    'value': response
                }).appendTo(config.container);
            },
            removedfile: function (file) {

                $(file.previewElement).find('.delete').attr('disabled', 'disabled');

                var id;

                if ('xhr' in file) {
                    id = file.xhr.response;
                }

                if ('id' in file) {
                    id = file.id;
                }

                if (typeof id === 'undefined') {
                    return;
                }

                $.ajax({
                    url: base_url + "/ch-admin/media/destroy",
                    data: {_token: $('meta[name="_token"]').attr('content'), id: id},
                    method: 'DELETE',
                    success: function (response) {
                        if (isNaN(parseInt(response))) {
                            return;
                        }

                        $(file.previewElement).remove();

                        $(config.container + ' input#media-' + response).remove();
                    },
                    error: function() {
                        $(file.previewElement).find('.delete').removeAttr('disabled');
                    }
                });
            },
            error: function (file, responseText) {
                $(file.previewElement).find('.error').text(responseText.errors);
            }
        });
    });
});
