<div class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="navbar-brand">
        <a href="index.html" class="d-inline-block">
            <img src="{{ multiauth_asset('images/logo_light.png') }}" alt="">
        </a>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
        <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
        <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
        <span class="navbar-text ml-md-3 mr-md-auto">
            <span class="badge bg-success">@lang('multilang::menu.online')</span>
        </span>
        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user('admin')->image ? asset(Auth::user()->image) : multiauth_asset('images/placeholders/placeholder.jpg') }}" class="rounded-circle" alt="">
                    <span>{{Auth::user()->first_name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.useredit') }}" class="dropdown-item"><i class="icon-user-plus"></i> @lang('multilang::menu.my_profile')</a>
                    <a href="{{ route('admin.password') }}" class="dropdown-item"><i class="icon-lock4"></i> @lang('multilang::menu.change_password')</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> @lang('multilang::menu.account_setting')</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="icon-switch2"></i> @lang('multilang::menu.logout')
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>