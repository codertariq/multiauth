@extends('multiauth::layouts.admin', ['title' => __('multilang::title.reset_password')])

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <form class="form-validate-jquery login-form" novalidate="novalidate" method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <h5 class="mb-0">@lang('multilang::admin.reset_title')</h5>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::admin.login_username')" value="{{ old('email') ? old('email') : '' }}" required="">
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::admin.login_password')" required="">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('multilang::admin.reset_con_password')" required="">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">@lang('multilang::admin.reset_submit') <i class="icon-circle-right2 ml-2"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/reset.js') }}"></script>
@endpush
