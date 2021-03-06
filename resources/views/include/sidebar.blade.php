<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
                {{-- <img class="header-brand-img" src="{{ asset('img/logo-tmb.png') }}" alt=""> --}}
               {{-- <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN">  --}}
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
    </div>
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                @can('mengelola administrator')
                <div class="nav-item {{ request()->is('user*') || request()->is('role*') || request()->is('permission*') || request()->is('activity-logs') ? 'active open' : '' }} has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('lihat user')
                        <a href="{{url('user')}}" class="menu-item {{ request()->is('user*') ? 'active' : '' }}">{{ __('User')}}</a>
                        @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('lihat role')
                        <a href="{{url('role')}}" class="menu-item {{ request()->is('role*') ? 'active' : '' }}">{{ __('Role')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('lihat permission')
                        <a href="{{url('permission')}}" class="menu-item {{ request()->is('permission*') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                        @can('melihat log aktivitas')
                        <a href="{{route('activity.log')}}" class="menu-item {{ request()->is('activity-logs') ? 'active' : '' }}">{{ __('Log Aktivitas')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan   

                @can('mengelola master')
                <div class="nav-item {{ request()->is(['product*', 'warehouse*', 'product-type*', 'suppliers*']) ? 'active open' : '' }} has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-box"></i><span>{{ __('Master')}}</span></a>
                    <div class="submenu-content">
                        @can('lihat gudang')
                        <a href="{{route('warehouses.index')}}" class="menu-item {{ request()->is('warehouses*') ? 'active' : '' }}">{{ __('Gudang')}}</a>
                        @endcan
                        @can('lihat tipe produk')
                        <a href="{{route('product-types.index')}}" class="menu-item {{ request()->is('product-types*') ? 'active' : '' }}">{{ __('Tipe Produk')}}</a>
                        @endcan
                        @can('lihat grup produk')
                        <a href="{{route('product-groups.index')}}" class="menu-item {{ request()->is('product-groups*') ? 'active' : '' }}">{{ __('Grup Produk')}}</a>
                        @endcan
                        @can('lihat unit produk')
                        <a href="{{route('product-units.index')}}" class="menu-item {{ request()->is('product-units*') ? 'active' : '' }}">{{ __('Unit Produk')}}</a>
                        @endcan
                        @can('lihat produk')
                        <a href="{{route('products.index')}}" class="menu-item {{ request()->is('products*') ? 'active' : '' }}">{{ __('Produk')}}</a>
                        @endcan
                        @can('lihat supplier')
                        <a href="{{route('suppliers.index')}}" class="menu-item {{ request()->is('suppliers*') ? 'active' : '' }}">{{ __('Supplier')}}</a>
                        @endcan
                        @can('lihat pelanggan')
                        <a href="index.html" class="menu-item">{{ __('Pelanggan')}}</a>
                        @endcan
                        @can('lihat sales')
                        <a href="index.html" class="menu-item">{{ __('Sales')}}</a>
                        @endcan
                        @can('lihat batas kredit')
                        <a href="index.html" class="menu-item">{{ __('Batas Kredit')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan  

                @can('lihat persediaan')
                 <div class="nav-item {{ request()->is(['stocks*']) ? 'active open' : '' }} has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-box"></i><span>{{ __('Persediaan')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{route('stocks')}}" class="menu-item {{ request()->is('stocks*') ? 'active' : '' }}">{{ __('Data Persediaan')}}</a>
                        <a href="index.html" class="menu-item">{{ __('Pemindahan Persediaan')}}</a>
                    </div>
                </div>
                @endcan

                @can('mengelola pembelian')
                <div class="nav-item {{ request()->is(['purchases*', 'purchase_payments*']) ? 'active open' : '' }} has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-shopping-cart"></i><span>{{ __('Pembelian')}}</span></a>
                    <div class="submenu-content">
                        @can('lihat pemesanan pembelian')
                        <a href="index.html" class="menu-item">{{ __('Pemesanan Pembelian')}}</a>
                        @endcan
                        @can('lihat pembelian')
                        <a href="{{route('purchases.index')}}" class="menu-item {{ request()->is('purchases*') ? 'active' : '' }}">{{ __('Faktur Pembelian')}}</a>
                        @endcan
                        @can('tambah pelunasan pembelian')
                        <a href="{{route('purchase_payments.index')}}" class="menu-item {{ request()->is('purchase_payments*') ? 'active' : '' }}">{{ __('Pelunasan')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan 

                @can('mengelola penjualan')
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-shopping-cart"></i><span>{{ __('Penjualan')}}</span></a>
                    <div class="submenu-content">
                        @can('lihat pemesanan penjualan')
                        <a href="index.html" class="menu-item">{{ __('Pemesanan Penjualan')}}</a>
                        @endcan
                        @can('lihat penjualan')
                        <a href="index.html" class="menu-item">{{ __('Faktur Penjualan')}}</a>
                        @endcan
                        @can('tambah pelunasan penjualan')
                        <a href="index.html" class="menu-item">{{ __('Pelunasan')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan 
            </nav>          
        </div>
    </div>
</div>