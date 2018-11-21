@extends('multiauth::layouts.admin', ['title' => __('multilang::title.verify_email')])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('multilang::admin.verify_title') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('multilang::admin.verify_status') }}
                        </div>
                    @endif
                    {!! __('multilang::admin.verify_msg') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
