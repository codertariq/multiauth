@extends('multiauth::layouts.admin', ['title' => __('multilang::title.edit_admin')])
@section('content')
<div class="content">
    <div class=" d-flex justify-content-center align-items-center">
        <!-- Registration form -->
        @if(isset($token))
        <form class="form-validate-jquery flex-fill" novalidate="novalidate" method="POST" action="{{ route('admin.userupdate') }}" enctype="multipart/form-data">
        @else
        <form class="form-validate-jquery flex-fill" novalidate="novalidate" method="POST" action="{{ route('admin.update', $admin->id) }}" enctype="multipart/form-data">
        @endif
            @csrf
            @method('PUT')
            @if(isset($token))
            <input type="hidden" name="id" value="{{ $admin->id }}">
            <input type="hidden" name="token" value="{{ $token }}">
            @endif
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
                                <h5 class="mb-0">{{$admin->first_name}}@lang('multilang::admin.edit_title')</h5>
                                @include('multiauth::msg')
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.first_name')" name="first_name" value="{{ old('first_name') ? old('first_name') : $admin->first_name }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.last_name')" name="last_name" value="{{ old('last_name') ? old('last_name') : $admin->last_name  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.dob')" name="dob" value="{{ old('dob') ? old('dob') : $admin->dob  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-calendar52 text-muted"></i>
                                        </div>
                                        @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.nid')" name="nid" value="{{ old('nid') ? old('nid') : $admin->nid  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-vcard text-muted"></i>
                                        </div>
                                        @if ($errors->has('nid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nid') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.address')" name="address" value="{{ old('address') ? old('address') : $admin->address  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-notebook text-muted"></i>
                                        </div>
                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.city')" name="city" value="{{ old('city') ? old('first_name') : $admin->city  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-location4 text-muted"></i>
                                        </div>
                                        @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-0 form-group-feedback form-group-feedback-right">
                                        {{-- <label class="d-block">Gender:</label> --}}
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-input-styled" name="gender" checked data-fouc value="0" {{ old('gender') == 0 || $admin->gender == 0 ? 'checked' : '' }}>
                                                @lang('multilang::input.male')
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-input-styled" name="gender" data-fouc value="1" {{ old('gender') == 1 || $admin->gender == 1 ? 'checked' : '' }}>
                                                @lang('multilang::input.female')
                                            </label>
                                        </div>
                                        <div class="form-control-feedback">
                                            <i class="icon-man-woman text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($admin->image)
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-input-styled" name="image_action" data-fouc value="0" id="delete_image">
                                                        @lang('multilang::input.delete_photo')
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-input-styled" name="image_action" data-fouc value="1" id="upload_image">
                                                        @lang('multilang::input.upload_photo')
                                                    </label>
                                                </div>
                                            </div>
                                            @if ($errors->has('image'))
                                            <span style="color:red;" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <div class="form-group">
                                            <input type="hidden" value="2" name="image_action">
                                            <input type="file" class="form-input-styled" data-fouc accept="image/*" name="image">
                                            @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @if($admin->image)
                            <div class="row" id="upload_image_field" style="display: none">
                                <div class="col-md-12">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <div class="form-group">
                                            <input type="file" class="form-input-styled" data-fouc accept="image/*" name="image">
                                            @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.mobile')" name="mobile" value="{{ old('mobile') ? old('mobile') : $admin->mobile  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-mobile3 text-muted"></i>
                                        </div>
                                        @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::input.email')" name="email" value="{{ old('email') ? old('email') : $admin->email  }}" required>
                                        <div class="form-control-feedback">
                                            <i class="icon-mention text-muted"></i>
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> @lang('multilang::input.update')</button>
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
<script src="{{ multiauth_asset('js/pages/edit.js') }}"></script>
@endpush