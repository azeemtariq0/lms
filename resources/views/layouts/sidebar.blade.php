<div class="fixed left-0 top-16 bottom-0 z-20 text-white w-[256px] transition-[width] ease-in-out duration-300 "
    id="sidebar">
</div>

<script>
    $(document).ready(() => {
        // Sidebar init
        const currentPath = "{{ \Request::segment(2) }}";
        const sidebarRoutes = [{
                icon: 'fa-solid text-sm fa-house',
                title: 'Dashboard',
                link: "{{ url('admin/dashboard') }}",
                key: 'dashboard',
                permission: true
            },
            {
                icon: 'fa-solid text-sm fa-circle-user',
                title: 'Administration',
                submenu: [{
                        title: 'Users',
                        link: "{{ route('admin.users.index') }}",
                        key: 'users',
                        permission: {{ auth()->user()->can('user.list') == 1 ? 1 : 0 }}
                    },
                    {
                        title: 'Permissions',
                        link: "{{ route('admin.permissions.index') }}",
                        key: 'permissions',
                        permission: {{ auth()->user()->can('user_permission.list') == 1 ? 1 : 0 }}
                    }
                ]
            },
            {
                icon: 'fa-solid text-sm fa-box',
                title: 'General Group',
                submenu: [{
                        title: 'Banners',
                        link: "{{ route('admin.banners.index') }}",
                        key: 'banners',
                        permission: {{ auth()->user()->can('banners.list') == 1 ? 1 : 0 }}
                    },
                    {
                        title: 'Category',
                        link: "{{ route('admin.categories.index') }}",
                        key: 'categories',
                        permission: {{ auth()->user()->can('categories.list') == 1 ? 1 : 0 }}
                    },
                ]
            },
            {
                icon: 'fa-solid text-sm fa-screwdriver-wrench',
                title: 'Settings',
                link: '/settings',
                permission: true
            },
            {
                icon: 'fa-solid text-sm fa-right-from-bracket',
                title: 'Logout',
                link: "{{ route('logout') }}",
                key: 'logout',
                permission: true
            }
        ];

        new Sidebar({
            bg: '#023c40',
            routes: sidebarRoutes,
            sidebarElement: '#sidebar',
            sidebarMenuElement: '#sidebarMenu',
            toggleElement: '#toggleSidebar',
            mainContentElement: '#mainContent',
            currentPath
        });


        // Breadcrumb init
        new Breadcrumb({
            breadcrumbElement: '#breadcrumbs',
            routes: sidebarRoutes,
            currentPath
        });
    });
</script>


{{-- <aside id="aside">
                <!--
                    Always open:
                    <li class="active alays-open">

                    LABELS:
                        <span class="label label-danger pull-right">1</span>
                        <span class="label label-default pull-right">1</span>
                        <span class="label label-warning pull-right">1</span>
                        <span class="label label-success pull-right">1</span>
                        <span class="label label-info pull-right">1</span>
                    -->
                    <nav id="sideNav"><!-- MAIN MENU -->
                        <ul class="nav nav-list">
                            <li class="{{ in_array(\Request::segment(1),array('home')) ? 'active' : '' }}"><!-- dashboard -->
                                <a class="dashboard" href="{{ url('admin/') }}"><!-- warning - url used by default by ajax (if eneabled) -->
                                    <i class="main-icon fa fa-dashboard"></i> <span>Dashboard



                                    </span>
                                </a>
                            </li>
                           
                           
                            <li class="{{ in_array(\Request::segment(1), array('users', 'roles', 'admin')) ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i> <i class="main-icon fa fa-users"></i> <span>Administration</span>
                                </a>
                                <ul><!-- submenus -->
                                    <li class="{{ \Request::segment(1) == 'admin' && \Request::segment(2) == 'permissions' ? 'active' : '' }}">
                                        <a href="{{ route('admin.permissions.index') }}">Permissions</a>
                                    </li>

                                    @can('user.add')
                                    <li class="{{ \Request::segment(1) == 'admin' && \Request::segment(2) == 'users' ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.index') }}">Users</a>
                                    </li>
                                    @endcan

                                     @can('banners.add')
                                    <li class="{{ \Request::segment(1) == 'admin' && \Request::segment(2) == 'banners' ? 'active' : '' }}">
                                        <a href="{{ route('admin.banners.index') }}">Banners</a>
                                    </li>
                                    @endcan
                                 
                                    

                                </ul>
                            </li>

                           


                    
                           
                             <li ><!-- dashboard -->
                                <a class="dashboard" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><!-- warning - url used by default by ajax (if eneabled) -->
                                    <i class="main-icon fa fa-power-off"></i> <span>Logout



                                    </span>
                                </a>
                            </li>
                        </ul>

                    </nav>

                    <span id="asidebg"><!-- aside fixed background --></span>
                </aside> --}}
