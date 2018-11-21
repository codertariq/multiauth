@extends('multiauth::layouts.admin', ['title' => __('multilang::title.edit_role')])
@section('content')
<div class="content">
    <div class=" d-flex justify-content-center align-items-center">
        <!-- Registration form -->
        <form class="form-validate-jquery flex-fill" novalidate="novalidate" method="POST" action="{{ route('role.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-pencil icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">@lang('multilang::admin.edit_role_title') - {{"'".$role->name."'"}}</h5>
                                <span class="d-block text-muted">@lang('multilang::admin.edit_role_msg')</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('role_name') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.role_name')" name="role_name" value="{{ old('role_name') ? old('role_name') : $role->name }}" required>
                                        @if ($errors->has('role_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <div class="form-group">
                                            <select multiple data-placeholder="@lang('multilang::input.select_permission')" class="form-control form-control-select2{{ $errors->has('password') ? ' is-invalid' : '' }}" name="permission[]">
                                                 @forelse($permissions as $permission)
                                            <option value="{{$permission->id}}"
                                                @if(old('permission'))
                                                @for($i=0; $i<count(old('permission')); $i++)
                                                {{ old('permission.'.$i) == $permission->id ? 'selected': ''}}
                                                @endfor
                                                @else
                                                @foreach($role->permissions as $rp)
                                                {{ $rp->id == $permission->id ? 'selected': ''}}
                                                @endforeach
                                            @endif
                                            >{{$permission->name}}</option>
                                            @empty
                                            <option>@lang('multilang::input.no_permission')</option>
                                            @endforelse
                                        </select>
                                        </div>
                                        <div class="form-control-feedback">
                                            <i class="icon-mention icon-hat"></i>
                                        </div>
                                        @if ($errors->has('permission'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('permission[]') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> @lang('multilang::admin.update_role')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /registration form -->
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ multiauth_asset('/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ multiauth_asset('js/pages/register.js') }}"></script>
@endpush