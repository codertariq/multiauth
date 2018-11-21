<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name')}}</title>
        <!-- Global stylesheets -->
        @include('multiauth::_partials.admin.stylesheets')
        <!-- /global stylesheets -->
    </head>
    <body @auth('admin')class="navbar-top"@endauth id="app">
        @auth('admin')
        <!-- Main navbar -->
        @include('multiauth::_partials.admin.main_navbar')
        <!-- /main navbar -->
        @endauth
        <!-- Page content -->
        <div class="page-content">
            @auth('admin')
            <!-- Main sidebar -->
            <div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">
                <!-- Sidebar mobile toggler -->
                @include('multiauth::_partials.admin.sidebar_mobile_toggler')
                <!-- /sidebar mobile toggler -->
                <!-- Sidebar content -->
                <div class="sidebar-content">
                    <!-- User menu -->
                    @include('multiauth::_partials.admin.user_menu')
                    <!-- /user menu -->
                    <!-- Main navigation -->
                    @include('multiauth::_partials.admin.main_navigation')
                    <!-- /main navigation -->
                </div>
                <!-- /sidebar content -->
            </div>
            <!-- /main sidebar -->
            @endauth
            <!-- Main content -->
            <div class="content-wrapper">
                @auth('admin')
                <!-- Page header -->
                @include('multiauth::_partials.admin.page_header')
                <!-- /page header -->
                @endauth
                <!-- Content area -->
                <div class="content">
                    @section('content')
                    @show
                </div>
                <!-- /content area -->
                @auth('admin')
                <!-- Footer -->
                @include('multiauth::_partials.admin.footer')
                <!-- /footer -->
                @endauth
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
        @include('multiauth::_partials.admin.scripts')
    </body>
</html>