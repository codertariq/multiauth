<div class="list-icons">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			<a href="{{ route('admin.show', $admin->id) }}" class="dropdown-item"><i class="icon-eye"></i> @lang('multilang::index.view')</a>
			<a href="{{ route('admin.edit', $admin->id) }}" class="dropdown-item"><i class="icon-pencil"></i> @lang('multilang::index.edit')</a>
			@if(Auth::user()->id != $admin->id)
			<a href="{{ route('admin.assign.role', $admin->id) }}" class="dropdown-item"><i class="icon-hat"></i> @lang('multilang::index.assign_role')</a>
			@if($admin->status == 1)
			<a href="{{ route('admin.action', $admin->id) }}" data-id="{{$admin->id}}" data-action="suspend" id="suspend_admin" class="dropdown-item"><i class="icon-thumbs-down2"></i> @lang('multilang::index.suspend')</a>
			@elseif($admin->status == 0)
			<a href="{{ route('admin.action', $admin->id) }}" data-id="{{$admin->id}}" data-action="getback" id="suspend_admin" class="dropdown-item"><i class="icon-thumbs-up2"></i> @lang('multilang::index.activate')</a>
			@endif
			<a href="{{ route('admin.destroy', $admin->id) }}" data-id="{{$admin->id}}" id="delete_item"class="dropdown-item"><i class="icon-trash"></i> @lang('multilang::index.delete')</a>
			<form id="delete-form-{{$admin->id}}" action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display: none;">
				@method('DELETE')
				@csrf
			</form>
			<form id="suspend-form-{{$admin->id}}" action="{{ route('admin.action', $admin->id) }}" method="POST" style="display: none;">
				@method('PUT')
				@csrf
			</form>
			@endif
		</div>
	</div>
</div>