<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <!-- Main -->
        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{ __('multilang::menu.main') }}</div> <i class="icon-menu" title="Main"></i></li>
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="icon-home4"></i>
                <span>
                    {{ __('multilang::menu.dashboard') }}
                    {{-- <span class="d-block font-weight-normal opacity-50">No active orders</span> --}}
                </span>
            </a>
        </li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>{{ __('multilang::menu.layouts') }}</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link active">Default layout</a></li>
            </ul>
        </li>
        <!-- Admin kits -->
            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{ __('multilang::menu.admin_kits') }}</div> <i class="icon-menu" title="Admin kits"></i></li>
            <li class="nav-item nav-item-submenu {{url()->current() == route('admin.register') || url()->current() == route('admin.index') ? ' nav-item-open' : ''}}">
                <a class="nav-link"><i class="icon-people"></i> <span>{{ __('multilang::menu.admin_kits') }}</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Admin pages" {!!url()->current() == route('admin.register') || url()->current() == route('admin.index') ? 'style="display: block;"' : ''!!}>
                    <li class="nav-item"><a href="{{ route('admin.index') }}" class="nav-link{{url()->current() == route('admin.index') ? ' active' : ''}}">{{ __('multilang::menu.admin_list') }}</a></li>
                    <li class="nav-item"><a href="{{ route('admin.register') }}" class="nav-link{{url()->current() == route('admin.register') ? ' active' : ''}}">{{ __('multilang::menu.admin_registration') }}</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-submenu {{url()->current() == route('role.create') || url()->current() == route('role.index') ? ' nav-item-open' : ''}}">
                <a href="#" class="nav-link"><i class="icon-hat"></i> <span>{{ __('multilang::menu.role_kits') }}</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="Role pages" {!!url()->current() == route('role.create') || url()->current() == route('role.index') ? 'style="display: block;"' : ''!!}>
                    <li class="nav-item"><a href="{{ route('role.index') }}" class="nav-link{{url()->current() == route('role.index') ? ' active' : ''}}">{{ __('multilang::menu.role_list') }}</a></li>
                    <li class="nav-item"><a href="{{ route('role.create') }}" class="nav-link{{url()->current() == route('role.create') ? ' active' : ''}}">{{ __('multilang::menu.create_role') }}</a></li>
                </ul>
            </li>
            <!-- /page kits -->

    </ul>
</div>