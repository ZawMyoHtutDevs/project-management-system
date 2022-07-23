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
                <span class="text-gray">{{$user->email}}</span>
            </div>
        </div>
        <div class="d-md-flex align-items-center d-none">
            <div class="media align-items-center m-r-40 m-v-5">
                <div class="font-size-27">
                    <i class="text-primary anticon anticon-profile"></i>
                </div>
                <div class="d-flex align-items-center m-l-10">
                    <h2 class="m-b-0 m-r-5">{{count($user->tasks)}}</h2>
                    <span class="text-gray">Tasks</span>
                </div>
            </div>
            <div class="media align-items-center m-r-40 m-v-5">
                <div class="font-size-27">
                    <i class="text-success  anticon anticon-appstore"></i>
                </div>
                <div class="d-flex align-items-center m-l-10">
                    <h2 class="m-b-0 m-r-5">{{count($user->projects)}}</h2>
                    <span class="text-gray">Projects</span>
                </div>
            </div>
            <div class="media align-items-center m-v-5">
                <div class="font-size-27">
                    <i class="text-danger anticon anticon-issues-close"></i>
                </div>
                <div class="d-flex align-items-center m-l-10">
                    <h2 class="m-b-0 m-r-5">{{count($user->tasks->where('status', '=', 'incomplete'))}}</h2>
                    <span class="text-gray">Pending Tasks</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Projects</h5>
                    <div>
                        <a href="{{route('projects.index')}}" class="btn btn-default btn-sm">View All</a> 
                    </div>
                </div>
                <div class="table-responsive m-t-30">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Tasks</th>
                                <th>Status</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->projects->slice(0, 6) as $item)
                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        
                                        <div class="">
                                            <h5 class="m-b-0">{{$item->name}}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{count($item->tasks)}} Tasks</span>
                                </td>
                                <td>
                                    <span class="badge badge-pill 
                                            @switch($item->status)
                                            @case('not started')
                                            badge-default
                                            @break
                                            @case('in progress')
                                            badge-info
                                            @break
                                            @case('on hold')
                                            badge-warning
                                            @break
                                            @case('cancled')
                                            badge-dange
                                            @break
                                            @default
                                            badge-success    
                                            @endswitch
                                            " style="text-transform:capitalize;">{{$item->status}}
                                        </span>
                                
                                </td>
                                <td>
                                <div class="d-flex align-items-center">
                                    @php
                                    if(count($item->tasks)){
                                        $countPercent = count($item->tasks->where('status', '=', 'completed')) / count($item->tasks);
                                        $percentage = $countPercent * 100;
                                    }
                                    @endphp
                                    <div class="progress progress-sm w-100 m-b-0">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$percentage ?? '0'}}%"></div>
                                    </div>
                                    <div class="m-l-10">
                                        {{$percentage ?? '0'}}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Assigned tasks</h5>
                    <div>
                        <a href="{{route('tasks.index')}}" class="btn btn-default btn-sm">View All</a> 
                    </div>
                </div>
                <div class="table-responsive m-t-30">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Project</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->tasks as $item)
                            <tr>
                                <td class="span">
                                    <h5 class="m-b-0">{{$item->name}}</h5>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-pill 
                                            @switch($item->status)
                                            @case('incomplete')
                                            badge-danger
                                            @break
                                            @default
                                            badge-success    
                                            @endswitch
                                            " style="text-transform:capitalize;">
                                            {{$item->status}}
                                        </span>
                            </td>
                            <td>
                                <p class="text-success"
                                @php
                                $today_time = strtotime(Carbon\Carbon::now()->format('d-M-Y'));
                                $expire_time = strtotime(Carbon\Carbon::parse($item->end_date)->format('d-M-Y'));
                                @endphp 
                                @if ($expire_time < $today_time)
                                style="color:red  !important;"
                                @endif
                                >
                                {{ Carbon\Carbon::parse($item->end_date)->format('d-M-Y') }}
                                </p>
                            </td>
                            <td>
                                <span>{{$item->project->name}}</span>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection