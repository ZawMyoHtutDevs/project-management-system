<div class="header">
    <div class="logo logo-dark">
        <a href="/">
            <img src="{{asset('backend/images/logo/logo.png')}}" alt="Logo">
            <img class="logo-fold" src="{{asset('backend/images/logo/logo-fold.png')}}" alt="Logo">
        </a>
    </div>
    <div class="logo logo-white">
        <a href="/">
            <img src="{{asset('backend/images/logo/logo-white.png')}}" alt="Logo">
            <img class="logo-fold" src="{{asset('backend/images/logo/logo-fold-white.png')}}" alt="Logo">
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            
        </ul>
        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left">
                <a href="javascript:void(0);" data-toggle="dropdown">
                    <i class="anticon anticon-bell notification-badge"></i>
                    <small class="text-danger">{{count(Auth::user()->unreadNotifications)}}</small>
                </a>
                <div class="dropdown-menu pop-notification">
                    <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                        <p class="text-dark font-weight-semibold m-b-0">
                            <i class="anticon anticon-bell"></i>
                            <span class="m-l-10">Notification</span>
                        </p>
                        <a class="btn-sm btn-default btn" href="{{route('notification.delete', Auth::user()->id)}}">
                            <small>Delete All</small>
                        </a>
                        {{-- <a class="btn-sm btn-primary btn" href="javascript:void(0);">
                            <small>View All</small>
                        </a> --}}
                    </div>
                    <div class="relative">
                        <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                            
                            @foreach (Auth::user()->unreadNotifications as $notification)
                            <a href="{{$notification->data['url'] ?? ''}}" class="dropdown-item d-block p-15 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-blue avatar-icon h-20">
                                        <i class="anticon anticon-mail"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark text-wrap">{{$notification->data['data']}}</p>
                                        <p class="m-b-0">
                                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            
                        
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <img src="{{asset('backend/images/user.png')}}"  alt="HapEye">
                    </div>
                </div>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                                <img src="{{asset('backend/images/user.png')}}" alt="HapEye">
                            </div>
                            <div class="m-l-10">
                                <p class="m-b-0 text-dark font-weight-semibold">{{ Auth::user()->name }}</p>
                                <p class="m-b-0 opacity-1">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="
                    {{route('users.detail', Auth::user()->id)}}
                    " class="dropdown-item d-block p-h-15 p-v-10">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                            <span class="m-l-10">Edit Profile</span>
                        </div>
                        <i class="anticon font-size-10 anticon-right"></i>
                    </div>
                </a>
                
                @admin
                <a href="
                {{route('users')}}
                " class="dropdown-item d-block p-h-15 p-v-10">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <i class="anticon opacity-04 font-size-16 anticon-lock"></i>
                        <span class="m-l-10">Account Setting</span>
                    </div>
                    <i class="anticon font-size-10 anticon-right"></i>
                </div>
            </a>
            @endadmin
            
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item d-block p-h-15 p-v-10">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                    <span class="m-l-10">Logout</span>
                </div>
                <i class="anticon font-size-10 anticon-right"></i>
            </div>
            
            {{-- logout form --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- end logout form --}}
        </a>
    </div>
</li>

</ul>
</div>
</div>    