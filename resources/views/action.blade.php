<div class="list-icons">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			<a href="{{ route($route.'.show', $data->id) }}" id="view_role" class="dropdown-item"><i class="icon-eye"></i> @lang('multilang::index.view')</a>
			<a href="{{ route($route.'.edit', $data->id) }}" class="dropdown-item"><i class="icon-pencil"></i> @lang('multilang::index.edit')</a>
			<a href="{{ route($route.'.destroy', $data->id) }}" data-id="{{$data->id}}" id="delete_item"class="dropdown-item"><i class="icon-trash"></i> @lang('multilang::index.delete')</a>
			<form id="delete-form-{{$data->id}}" action="{{ route($route.'.destroy', $data->id) }}" method="POST" style="display: none;">
				@method('DELETE')
				@csrf
			</form>
		</div>
	</div>
</div>