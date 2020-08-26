
var cart = new Vue({
    el: '#cart',
    data: {
        updating: false,
        countries: countries,
        states: states,
        cartData: {
            addons: addons,
            billing_country: billing_country,
            billing_state: billing_state
        }
    },
    methods: {
        updateCart: function () {
            this.updating = true;
            axios.post(cart_url, this.cartData)
                .then(response => {
                    console.log(this.updating = false);
                    $('.summary').empty().html($(response.data).find('.summary'));
                })
                .catch(error => {
                    this.updating = false;
                }).finally(() => {
                this.updating = false;
            });
        },

        updateStates: function (event) {

            axios.post(base_url + '/ch-admin/ajax', {
                country_id: event.target.value,
                action: 'cart_get_states',
                _token: $('meta[name="csrf-token"]').attr('content')
            })
                .then(response => {
                    this.states = response.data;
                    this.cartData.billing_state = 0;
                })
                .catch(error => {

                }).finally(() => {

            });
        }
    },
    watch: {
        cartData: {
            handler: function (val, oldVal) {
                this.updateCart();
            },
            deep: true
        }
    }
});


Dropzone.autoDiscover = false;

Dropzone.options.fileupload = {
    init: function () {
        thisDropzone = this;
        this.on("error", function (file, responseText) {
            $.each(responseText, function (index, value) {
                $('.dz-error-message').text(value);
            });
        });
    }
};

$('.dropzone').each(function () {
    var parent = $(this).parent('.formbuilder-file.form-group');
    var prop = parent.data('prop');

    var types_array = prop.allowed_types.toString().split(',');

    var types = types_array.map(function (type) {
        var newType = '.' + type.trim();
        return newType;
    });

    $(this).dropzone({
        maxFiles: prop.max_files,
        maxFilesize: prop.allowed_size,
        acceptedFiles: types.join(','),
        url: upload_url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        sending: function (file, xhr, formData) {
            formData.append('form_id', service_id);
            formData.append('input_name', prop.name);
        },
        success: function (file, response) {
            if (isNaN(parseInt(response))) {
                return;
            }

            $('<input>', {
                'id': 'media-' + response,
                'type': 'hidden',
                'name': 'form_data[' + prop.name + '][]',
                'value': response
            }).appendTo('form#payment-form');
        }
    });
});