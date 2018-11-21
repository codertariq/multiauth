@extends('multiauth::layouts.admin', ['title' => __('multilang::title.assign_role').$admin->first_name.' '.$admin->last_name])
@section('content')
<div class="content">
    <div class=" d-flex justify-content-center align-items-center">
        <!-- Registration form -->
        <form class="form-validate-jquery flex-fill" novalidate="novalidate" method="POST" action="{{ route('admin.assign.role', $admin->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$admin->id}}">
            <input type="hidden" name="token" value="{{$token}}">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @if($admin->image)
                                <img src="{{asset('storage/'.$admin->image)}}" alt="" height="100" width="100" style="border-radius: 50%">
                                @else
                                <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                @endif
                                <h5 class="mb-0">@lang('multilang::admin.assign_role_to') {{$admin->first_name.' '.$admin->last_name}}</h5>
                                <span class="d-block text-muted">@lang('multilang::admin.assign_role_msg') </span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <div class="form-group">
                                            <select multiple data-placeholder="Chose Role" class="form-control form-control-select2{{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles[]">
                                                @forelse($roles as $role)
                                                <option value="{{$role->id}}"
                                                    @if(old('role'))
                                                    @for($i=0; $i<count(old('role')); $i++)
                                                    {{ old('role.'.$i) == $role->id ? 'selected': ''}}
                                                    @endfor
                                                    @else
                                                        @foreach($admin->roles as $rp)
                                                        {{ $rp->id == $role->id ? 'selected': ''}}
                                                        @endforeach
                                                    @endif
                                                >{{$role->name}}</option>
                                                @empty
                                                <option>No Roles</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="form-control-feedback">
                                            <i class="icon-mention icon-hat"></i>
                                        </div>
                                        @if ($errors->has('roles'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('roles[]') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> @lang('multilang::admin.create_role') </button>
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