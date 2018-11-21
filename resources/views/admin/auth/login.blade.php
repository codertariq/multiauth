@extends('multiauth::layouts.admin', ['title' => __('multilang::title.admin_login')])
@section('content')
<div class="d-flex justify-content-center align-items-center">
    <form class="form-validate-jquery login-form" novalidate="novalidate" method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">@lang('multilang::admin.login_title')</h5>
                    <span class="d-block text-muted">@lang('multilang::admin.login_msg')</span>
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
                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::admin.login_password')" required="">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group d-flex align-items-center">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }} data-fouc>
                            @lang('multilang::admin.login_remember')
                        </label>
                    </div>
                    <a href="{{ route('admin.password.request') }}" class="ml-auto">@lang('multilang::admin.login_forgot')</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">@lang('multilang::admin.login_submit') <i class="icon-circle-right2 ml-2"></i></button>
                </div>
                <div class="form-group text-center text-muted content-divider">
                    <span class="px-2">@lang('multilang::admin.login_with')</span>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-outline bg-indigo border-indigo text-indigo btn-icon rounded-round border-2"><i class="icon-facebook"></i></button>
                    <button type="button" class="btn btn-outline bg-pink-300 border-pink-300 text-pink-300 btn-icon rounded-round border-2 ml-2"><i class="icon-dribbble3"></i></button>
                    <button type="button" class="btn btn-outline bg-slate-600 border-slate-600 text-slate-600 btn-icon rounded-round border-2 ml-2"><i class="icon-github"></i></button>
                    <button type="button" class="btn btn-outline bg-info border-info text-info btn-icon rounded-round border-2 ml-2"><i class="icon-twitter"></i></button>
                </div>
                <div class="form-group text-center text-muted content-divider">
                    <span class="px-2">@lang('multilang::admin.login_no_account')</span>
                </div>
                <div class="form-group">
                    <a href="#" class="btn btn-light btn-block">@lang('multilang::admin.login_register')</a>
                </div>
                <span class="form-text text-center text-muted">@lang('multilang::admin.login_terms')</span>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="{{ multiauth_asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ multiauth_asset('js/pages/login.js') }}"></script>
@endpush