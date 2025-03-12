



<aside id="aside">
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

                                    @can('list', 'user')
                                    <li class="{{ \Request::segment(1) == 'admin' && \Request::segment(2) == 'users' ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.index') }}">Users</a>
                                    </li>
                                    @endcan


                                    <li class="{{ \Request::segment(1) == 'admin' && \Request::segment(2) == 'banners' ? 'active' : '' }}">
                                        <a href="{{ route('admin.banners.index') }}">Banners</a>
                                    </li>
                                 
                                    

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
                </aside>