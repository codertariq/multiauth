@extends('multiauth::layouts.admin', ['title' => __('multilang::title.dashboard')])

@section('content')
Tariq
@endsection

@push('scripts')
<script src="{{ asset('assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
<script src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endpush