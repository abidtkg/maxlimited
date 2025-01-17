<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('assets/admin/images/logos/maxspeed.png') }}" style="height: 50px; width: auto"
                    alt="Logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                {{-- NAV FOR ADMIN PAGE --}}
                @if (Auth::user()->user_type == 'admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">ADMIN PORTAL</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.expense*') ? 'active' : '' }}" href="{{ route('admin.expense.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-currency-taka"></i>
                            </span>
                            <span class="hide-menu">Expenses</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.product*') ? 'active' : '' }}" href="{{ route('admin.product.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-ticket"></i>
                            </span>
                            <span class="hide-menu">Product</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.purchase*') ? 'active' : '' }}" href="{{ route('admin.purchase.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-arrow-up"></i>
                            </span>
                            <span class="hide-menu">Purchase</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.order*') ? 'active' : '' }}" href="{{ route('admin.order.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-arrow-down"></i>
                            </span>
                            <span class="hide-menu">Orders</span>
                        </a>
                    </li>
                    {{-- con.req.index --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.con.req.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-git-pull-request"></i>
                            </span>
                            <span class="hide-menu">ISP Con. Requests</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.notice.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-news"></i>
                            </span>
                            <span class="hide-menu">Scroll Notice</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.ftp') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-cloud-computing"></i>
                            </span>
                            <span class="hide-menu">FTP Servers</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.package.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-package"></i>
                            </span>
                            <span class="hide-menu">Packages</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.slider.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-slideshow"></i>
                            </span>
                            <span class="hide-menu">Sliders</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.customform.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-info"></i>
                            </span>
                            <span class="hide-menu">Form Data</span>
                        </a>
                    </li>
                    
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">SETTINGS</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.location.upozilas') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-flag-3"></i>
                            </span>
                            <span class="hide-menu">Upozila</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.location.unions') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-route"></i>
                            </span>
                            <span class="hide-menu">Unions</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.terms.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-text"></i>
                            </span>
                            <span class="hide-menu">Terms & Conditions</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.expense.category.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-git-branch"></i>
                            </span>
                            <span class="hide-menu">Expense Category</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.zone*') ? 'active' : '' }}" href="{{ route('admin.zone.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-circles"></i>
                            </span>
                            <span class="hide-menu">Zones</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type == 'employee')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">EMPLOYEE</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}" href="{{ route('employee.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('employee.expense*') ? 'active' : '' }}" href="{{ route('employee.expense.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-currency-dollar"></i>
                        </span>
                        <span class="hide-menu">Expenses</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('employee.order*') ? 'active' : '' }}" href="{{ route('employee.order.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-arrow-down"></i>
                        </span>
                        <span class="hide-menu">Orders</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->user_type == 'client')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">CLIENT PANEL</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('client.dashboard*') ? 'active' : '' }}" href="{{ route('client.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('client.order.index') ? 'active' : '' }}" href="{{ route('client.order.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-archive"></i>
                        </span>
                        <span class="hide-menu">Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('client.order.place') ? 'active' : '' }}" href="{{ route('client.order.place') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-ticket"></i>
                        </span>
                        <span class="hide-menu">Order Card</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
