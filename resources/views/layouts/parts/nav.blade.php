<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{route('home')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-inbox"></i>
                    </span>
                    <span class="title">Projects</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('projects.*') ? 'active' : '' }}">
                        <a href="{{route('projects.index')}}">All Projects</a>
                    </li>
                    @manager()
                    <li class="">
                        <a href="{{route('projects.create')}}">Create New</a>
                    </li>
                    <li class="{{ Route::is('categories.*') ? 'active' : '' }}">
                        <a href="{{route('categories.index')}}">Project Categories</a>
                    </li>
                    @endmanager
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-profile"></i>
                    </span>
                    <span class="title">Tasks</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('tasks.*') ? 'active' : '' }}">
                        <a href="{{route('tasks.index')}}">All Tasks</a>
                    </li>
                    @manager()
                    <li class="">
                        <a href="{{route('tasks.create.one')}}">Create New</a>
                    </li>
                    <li class="{{ Route::is('task-categories.*') ? 'active' : '' }}">
                        <a href="{{route('task-categories.index')}}">Task Categories</a>
                    </li>
                    <li class="">
                        <a href="">Timer</a>
                    </li>
                    @endmanager
                    
                </ul>
            </li>

            @admin
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">Employees</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('users') ? 'active' : '' }}">
                        <a href="{{route('users')}}">All Employees</a>
                    </li>                
                    <li class=" {{ Route::is('departments.*') ? 'active' : '' }}">
                        <a href="{{route('departments.index')}}">Departments</a>
                    </li>
                    
                </ul>
            </li>

            {{-- Activiteis --}}
            <li class="nav-item  {{ Route::is('activity.log') ? 'active' : '' }}">
                <a class="" href="{{route('activity.log')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-hourglass"></i>
                    </span>
                    <span class="title">Activity Log</span>
                </a>
            </li>

            @endadmin

            
            @manager()
            {{-- Clients --}}
            <li class="nav-item  {{ Route::is('clients.*') ? 'active' : '' }}">
                <a class="" href="{{route('clients.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
                    </span>
                    <span class="title">Clients</span>
                </a>
            </li>
            @endmanager

        </ul>
    </div>
</div>