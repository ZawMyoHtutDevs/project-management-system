@extends('layouts.app')
@section('style')
    
@endsection
@section('content')
<div class="page-header no-gutters">
    <div class="d-md-flex align-items-md-center justify-content-between">
        <div class="media m-v-10 align-items-center">
            <div class="avatar avatar-image avatar-lg">
                <img src="{{asset('backend/images/user.png')}}" alt="">
            </div>
            <div class="media-body m-l-15">
                <h4 class="m-b-0">Welcome back, {{ $user->name }}!</h4>
                <span class="text-gray">Admin</span>
            </div>
        </div>
        <div class="d-md-flex align-items-center d-none">
            <div class="media align-items-center m-r-40 m-v-5">
                <div class="font-size-27">
                    <i class="text-primary anticon anticon-team"></i>
                </div>
                <div class="d-flex align-items-center m-l-10">
                    <h2 class="m-b-0 m-r-5">{{count($users)}}</h2>
                    <span class="text-gray">Employees</span>
                </div>
            </div>
            <div class="media align-items-center m-r-40 m-v-5">
                <div class="font-size-27">
                    <i class="text-success  anticon anticon-appstore"></i>
                </div>
                <div class="d-flex align-items-center m-l-10">
                    <h2 class="m-b-0 m-r-5">{{count($projects)}}</h2>
                    <span class="text-gray">Projects</span>
                </div>
            </div>
            <div class="media align-items-center m-v-5">
                <div class="font-size-27">
                    <i class="text-danger anticon anticon-team"></i>
                </div>
                <div class="d-flex align-items-center m-l-10">
                    <h2 class="m-b-0 m-r-5">{{count($clients)}}</h2>
                    <span class="text-gray">Clients</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-blue">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{count($tasks)}}</h2>
                                <p class="m-b-0 text-muted">Total Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{count($tasks->where('status', '=', 'completed'))}}</h2>
                                <p class="m-b-0 text-muted">Completed Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-red">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{count($tasks->where('status', '=', 'incomplete'))}}</h2>
                                <p class="m-b-0 text-muted">Incomplete Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-red">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="m-l-15">
                                <h2 class="m-b-0">{{count($tasks->where('status', '=', 'incomplete')->where('end_date', '<', strtotime(Carbon\Carbon::now()->format('Y-m-d'))))}}</h2>
                                <p class="m-b-0 text-muted">Pending Tasks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body" style="max-height: 700px;overflow-x: auto;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Activity</h5>
                    <div>
                        <a href="" class="btn btn-default btn-sm">View All</a> 
                    </div>
                </div>
                <div class="m-t-40">
                    <ul class="timeline">
                        @foreach ($user->unreadNotifications as $notification)
                            
                        <li class="timeline-item">
                            <div class="timeline-item-head">
                                <div class="avatar avatar-icon bg-white">
                                    <i class="anticon anticon-info-circle font-size-22 text-success"></i>
                                </div>
                            </div>
                            <div class="timeline-item-content">
                                <div class="m-l-10">
                                    <p class="m-b-0">
                                        <span class="m-l-5">{{$notification->data['data']}}</span>
                                    </p>
                                    <span class="text-muted font-size-13">
                                        <i class="anticon anticon-clock-circle"></i>
                                        <span class="m-l-5">{{ $notification->created_at->diffForHumans() }}</span>
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection