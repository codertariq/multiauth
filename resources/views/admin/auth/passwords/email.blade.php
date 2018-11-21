@extends('multiauth::layouts.admin', ['title' => __('multilang::title.send_reset_mail')])
@section('content')
<div class="d-flex justify-content-center align-items-center">
    <form class="form-validate-jquery login-form" novalidate="novalidate" method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">@lang('multilang::admin.recover_title')</h5>
                    @if (session('status'))
                    <span class="d-block text-muted alert alert-success" role="alert">{{session('status')}}</span>
                @else
                    <span class="d-block text-muted">@lang('multilang::admin.recover_msg')</span>
                    @endif
                </div>
                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('multilang::admin.login_username')" value="{{ old('email') ? old('email') : '' }}" required>
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" class="btn bg-blue btn-block"><i class="icon-spinner11 mr-2"></i> @lang('multilang::admin.recover_submit')</button>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/password_recover.js') }}"></script>
@endpush