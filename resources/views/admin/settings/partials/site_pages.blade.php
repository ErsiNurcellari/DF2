<div class="form-group row">
    <label for="settings[tos]" class="col-sm-2 control-label">Terms of Service</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="settings[tos]" name="settings[tos]">{{ old('settings.tos', setting('tos')) }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="settings[privacy_policy]" class="col-sm-2 control-label">Privacy Policy</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="settings[privacy_policy]" name="settings[privacy_policy]">{{ old('settings.privacy_policy', setting('privacy_policy')) }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="settings[refund_policy]" class="col-sm-2 control-label">Refund Policy</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="settings[refund_policy]" name="settings[refund_policy]">{{ old('settings.refund_policy', setting('refund_policy')) }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="settings[contact_details]" class="col-sm-2 control-label">Contact Details</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="settings[contact_details]" name="settings[contact_details]">{{ old('settings.contact_details', setting('contact_details')) }}</textarea>
    </div>
</div>

@section('ch_header')
    <link rel="stylesheet" href="{{asset('assets/backend/js/vendors/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css')}}">
@endsection
@push('ch_footer')
    <script src="{{asset('assets/backend/js/vendors/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
    <script>
        $( function() {
            $('textarea').wysihtml5();
        } );
    </script>
@endpush
