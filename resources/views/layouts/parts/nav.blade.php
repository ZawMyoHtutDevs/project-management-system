<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{route('home')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Home</span>
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
                    <li class="">
                        <a href="{{route('projects.create')}}">Create New</a>
                    </li>
                    <li class="{{ Route::is('categories.*') ? 'active' : '' }}">
                        <a href="{{route('categories.index')}}">Project Categories</a>
                    </li>
                    
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
                    <li class="">
                        <a href="{{route('tasks.create.one')}}">Create New</a>
                    </li>
                    <li class="{{ Route::is('task-categories.*') ? 'active' : '' }}">
                        <a href="{{route('task-categories.index')}}">Task Categories</a>
                    </li>
                    <li class="">
                        <a href="">Timer</a>
                    </li>
                    
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
            @endadmin

            
            
            {{-- Clients --}}
            <li class="nav-item  {{ Route::is('clients.*') ? 'active' : '' }}">
                <a class="" href="{{route('clients.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
                    </span>
                    <span class="title">Clients</span>
                </a>
            </li>

        </ul>
    </div>
</div>