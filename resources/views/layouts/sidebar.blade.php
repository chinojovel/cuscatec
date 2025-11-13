<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    {{-- <body data-layout="horizontal" data-sidebar="dark"> --}}
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30"> <span
                    class="logo-txt">@lang('translation.Ecommerce')</span>
            </span>
        </a>

        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30"> <span
                    class="logo-txt">@lang('translation.Ecommerce')</span>
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                @can('administration.dashboard')
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">@lang('translation.Dashboard')</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ url('/') }}">
                                    <i class="bx bx-tachometer icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-dashboards">@lang('translation.Dashboard')</span>
                                    {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/dynamic-dashboard') }}">
                                    <i class="bx bx-tachometer icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-dashboards">Dynamic Dashboard</span>
                                    {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('administration.customers')
                    <li>
                        <a href="{{ route('customers.index') }}">
                            <i class="bx bxs-user-detail icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Customers</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                    </li>
                @endcan

                @can('administration.sellers')
                    <li>
                        <a href="{{ route('sellers.index') }}">
                            <i class="bx bxs-contact icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Sellers</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                    </li>
                @endcan

                @can('administration.states')
                    <li>
                        <a href="{{ route('states.index') }}">
                            <i class="bx bx-map-pin icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">States</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                    </li>
                @endcan

                @can('administration.products.index')
                    <li>
                        <a href="{{ route('products.index') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Products</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                    </li>
                @endcan

                @can('administration.orders')
                    <li>
                        <a href="{{ route('administration.orders.index') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Orders</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('administration.orders.all')
                                <li><a href="{{ route('administration.orders.index') }}" data-key="t-read-email">Orders</a>
                                </li>
                            @endcan
                            @can('administration.orders.modified')
                                <li><a href="{{ route('administration.orders.modified') }}" data-key="t-read-email">Modified
                                        Orders</a></li>
                            @endcan
                            @can('administration.products.sales.index')
                                <li><a href="{{ route('administration.products.sales.index') }}"
                                        data-key="t-read-email">Product Sales Report</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('administration.inventory')
                    <li>
                        <a href="{{ route('administration.inventory.index') }}">
                            <i class="bx bxs-home icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Inventory</span>
                            {{-- <span class="badge rounded-pill bg-success">@lang('translation.5+')</span> --}}
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
 
                            @can('administration.inventory')
                                <li><a href="{{ route('administration.warehouse.index') }}"
                                        data-key="t-read-email">Warehouses</a>
                                </li>
                            @endcan

                            @can('administration.inventory')
                                <li><a href="{{ route('administration.inventory.index') }}"
                                        data-key="t-read-email">Inventory</a>
                                </li>
                            @endcan
                             @can('administration.inventory')
                                <li><a href="{{ route('administration.kardex.index') }}"
                                        data-key="t-read-email">Kardex</a>
                                </li>
                            @endcan
                            @can('administration.warehouse.upload')
                                <li><a href="{{ route('administration.warehouse.upload') }}" data-key="t-read-email">Load
                                        stock</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('administration.categories')
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Categories</span>
                        </a>
                    </li>
                @endcan

                @can('administration.suppliers')
                    <li>
                        <a href="{{ route('suppliers.index') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Suppliers</span>
                        </a>
                    </li>
                @endcan

                @can('administration.purchase_orders')
                    <li>
                        <a href="{{ route('purchase_orders.index') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Purchase Orders</span>
                        </a>
                    </li>
                @endcan

                @can('administration.coupons')
                    <li>
                        <a href="{{ route('coupons.index') }}">
                            <i class="bx bxs-store icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards">Coupons</span>
                        </a>
                    </li>
                @endcan

                 @can('administration.users') 
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="bx bxs-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboards">Users</span>
                    </a>
                </li>
                 @endcan 
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
