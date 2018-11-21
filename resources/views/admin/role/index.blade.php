@extends('multiauth::layouts.admin', ['title' => __('multilang::title.role')])
@section('content')
<!-- Basic initialization -->
@include('multiauth::msg')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">@lang('multilang::index.role_list')<a href="{{ route('role.create') }}"> <button type="button" class="btn btn-link"><i class="icon-plus-circle2 mr-2"></i> @lang('multilang::index.add_role')</button> </a></h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="collapse"></a>
				<a class="list-icons-item" data-action="reload"></a>
				<a class="list-icons-item" data-action="remove"></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		@lang('multilang::index.role_msg')
	</div>
	<table class="table admin">
		<thead>
			<tr>
				<th>@lang('multilang::index.id')</th>
				<th>@lang('multilang::index.role')</th>
				<th>@lang('multilang::index.can')</th>
				<th>@lang('multilang::index.user')</th>
				<th>@lang('multilang::index.action')</th>
			</tr>
		</thead>
	</table>
</div>
<!-- /basic initialization -->
@endsection
@push('scripts')
<script src="{{ multiauth_asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/tables/datatables/extensions/jszip/jszip.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ multiauth_asset('js/pages/role.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ multiauth_asset('js/delete.js') }}"></script>
@endpush