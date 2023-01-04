                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">{{ config('app.name') }}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">LS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                        @role('administrator')
                        <li class="menu-header"><i>Auth</i></li>
                        <li class="{{ Request::is('permissions*') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/permissions') }}"><i class="fas fa-key"></i> <span>Permissions</span></a></li>
                        <li class="{{ Request::is('roles*') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/roles') }}"><i class="fas fa-user-tag"></i> <span>Roles</span></a></li>
                        <li class="{{ Request::is('users*') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/users') }}"><i class="fas fa-users-cog"></i> <span>Users</span></a></li>
         
                        <li class="dropdown {{ Request::is('category') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown  "><i class="fas fa-th-large"></i> <span>Task</span></a>

                            <ul class="dropdown-menu">
                                <li class="{{ Request::is('category') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/category')  }}"><i class="fas fa-book"></i> <span>Category</span></a></li>
                            </ul>
                        </li>
                        @endrole

                        <li class="menu-header">Tugas</li>
                        <li class="{{ Request::is('task') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/task') }}"><i class="fas fa-solid fa-check-double"></i> <span>Tugas Tersedia</span></a></li>
                        <li class="{{ Request::is('todo') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/todo') }}"><i class="fas fa-solid fa-check-double"></i> <span>Dikerjakan</span></a></li>
                 
                    </ul>

                </aside>