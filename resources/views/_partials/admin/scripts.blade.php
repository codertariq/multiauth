<!-- Core JS files -->
<script src="{{ multiauth_asset('js/main/jquery.min.js') }}"></script>
<script src="{{ multiauth_asset('js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ multiauth_asset('js/plugins/forms/validation/validate.min.js') }}"></script>
<!-- /core JS files -->
<!-- Theme JS files -->
@stack('scripts')
<script src="{{ multiauth_asset('js/app.js') }}"></script>
<!-- /theme JS files -->