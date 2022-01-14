<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                @can('mengelola master')
                <div class="nav-item {{ request()->is(['product*', 'warehouse*']) ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-box"></i><span>{{ __('Master')}}</span></a>
                    <div class="submenu-content">
                        @can('mengelola produk')
                        <a href="{{route('product.index')}}" class="menu-item {{ request()->is('product*') ? 'active' : '' }}">{{ __('Produk')}}</a>
                        @endcan
                        @can('mengelola gudang')
                        <a href="{{route('warehouse.index')}}" class="menu-item {{ request()->is('warehouse*') ? 'active' : '' }}">{{ __('Gudang')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan 

                @can('mengelola administrator')
                <div class="nav-item {{ request()->is('user*') || request()->is('role*') || request()->is('permission*') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('mengelola user')
                        <a href="{{url('user')}}" class="menu-item {{ request()->is('user*') ? 'active' : '' }}">{{ __('User')}}</a>
                        @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('mengelola role')
                        <a href="{{url('role')}}" class="menu-item {{ request()->is('role*') ? 'active' : '' }}">{{ __('Role')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('mengelola permission')
                        <a href="{{url('permission')}}" class="menu-item {{ request()->is('permission*') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan    
            </nav>          
        </div>
    </div>
</div>