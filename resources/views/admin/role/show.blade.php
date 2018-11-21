@extends('multiauth::layouts.admin', ['title' => __('multilang::title.view_role').$role->name])
@section('content')
<!-- Basic initialization -->
@include('multiauth::msg')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">@lang('multilang::index.role'): {{$role->name}} <a href="{{ route('role.create') }}"> <button type="button" class="btn btn-link"><i class="icon-plus-circle2 mr-2"></i> @lang('multilang::index.add_role')</button> </a></h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="collapse"></a>
				<a class="list-icons-item" data-action="reload"></a>
				<a class="list-icons-item" data-action="remove"></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		@lang('multilang::index.permission'): @forelse($role->permissions as $role)
						<span class="badge badge-success mr-1">{{ $role->name }}</span>
					@empty
					<span class="badge badge-danger mr-1">@lang('multilang::input.no_permission')</span>
					@endforelse

	</div>
	<table class="table admin">
		<thead>
			<tr>
				<th>@lang('multilang::index.id')</th>
				<th>@lang('multilang::index.user_name')</th>
				<th>@lang('multilang::index.email')</th>
				<th>@lang('multilang::index.mobile')</th>
			</tr>
		</thead>
		<tbody>
			@forelse($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->first_name.' '.$user->last_name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->mobile}}</td>
			</tr>
			@empty
			<tr>
				<td class="text-center" colspan="4">@lang('multilang::index.no_user')</td>
			</tr>
			@endforelse
		</tbody>
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
<script src="{{ multiauth_asset('js/pages/show_role.js') }}"></script>
@endpush