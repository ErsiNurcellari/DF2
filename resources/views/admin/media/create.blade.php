@extends('admin.layouts.master')

@section('title', 'Upload Media')

@section('content')
    @include('admin.media.upload')
@endsection
@push('ch_footer')
    <script src="{{ asset('assets/backend/js/vendors/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/media.js') }}"></script>
@endpush

