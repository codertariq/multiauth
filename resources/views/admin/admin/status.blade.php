@if($admin->status == 1)
<span class="badge badge-success"> @lang('multilang::index.status_active') </span>
@elseif($admin->status == 0)
<span class="badge badge-danger">@lang('multilang::index.status_inactive')</span>
@endif