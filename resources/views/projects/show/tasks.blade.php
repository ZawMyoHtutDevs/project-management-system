@extends('layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media align-items-center">
                                
                                <div class="m-l-1">
                                    <h4 class="m-b-0">{{$project->name}}</h4>
                                    <p>{{$project->category->name}}</p>
                                </div>
                            </div>
                            <div>
                                <span class="badge badge-pill 
                                    @switch($project->status)
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
                                    " style="text-transform:capitalize;">{{$project->status}}</span>
                                <span class="badge badge-pill badge-info" style="text-transform:capitalize;">{{$project->priority}}</span>
                            </div>
                        </div>
                        
                        <div class="d-md-flex m-t-30 align-items-center justify-content-between">
                            <div class="d-flex align-items-center m-t-10">
                                <span class="text-dark font-weight-semibold m-r-10 m-b-5">Team: </span>
                                @foreach ($project->users as $user)
                            
                                <span class="badge badge-pill 
                                @if ($user->utype == 'MAN')
                                    badge-warning
                                @elseif ($user->utype == 'ADM')
                                    badge-danger
                                @else
                                    badge-default
                                @endif
                                ">{{$user->name}}</span>
                            @endforeach
                            </div>
                            <div class="m-t-10">
                                <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Start Date: </span>
                                <span>{{ Carbon\Carbon::parse($project->start_date)->format('d-M-Y') }} </span><br>
                                <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Deadline: </span>
                                <span>{{ Carbon\Carbon::parse($project->end_date)->format('d-M-Y') }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-30">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item">
                                <a class="nav-link "  href="{{route('projects.show', $project->id)}}">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('projects.index')}}/{{$project->id}}/tasks">Tasks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('projects.index')}}/{{$project->id}}/comments">Comments</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('projects.index')}}/{{$project->id}}/attachments">Attachments</a>
                            </li>
                        </ul>
                        <div class="tab-content m-t-15 p-25">
                            <div class="tab-pane fade show active" id="project-details-attachment">
                                {{-- Task here --}}

                                <div class="row">

                                    @foreach ($tasks as $item)
                                    <div class="col-md-3 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="media">
                                                        
                                                        <div class="m-l-1">
                                                            <h5 class="m-b-0">{{$item->name}}</h5>
                                                            {{-- need to update --}}
                                                            <span class="text-muted font-size-13">{{$item->project->name}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown dropdown-animated scale-left">
                                                        <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                                                            <i class="anticon anticon-setting"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a href="{{route('tasks.show', $item->id)}}" class="dropdown-item" type="button">
                                                                <i class="anticon anticon-eye"></i>
                                                                <span class="m-l-10">View</span>
                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-t-10">
                                                    
                                                    <div>
                                                        @foreach ($item->users as $user)
                                                        <a class="m-r-5" href="javascript:void(0);" data-toggle="tooltip" title="{{$user->name}}">
                                                            <div class="avatar avatar-image avatar-sm"
                                                            @if ($user->utype == 'MAN')
                                                            style="border: 2px solid gold;"
                                                            @elseif ($user->utype == 'ADM')
                                                            style="border: 2px solid red;"
                                                            @endif
                                                            >
                                                                <img src="{{asset('backend/images/user.png')}}" alt="{{$user->name}}">
                                                            </div>
                                                        </a>
                                                        @endforeach
                                                        
                                                    </div>
                                                    <br>
                                                    <p class="text-success"
                                                    @php
                                                        $today_time = strtotime(Carbon\Carbon::now()->format('d-M-Y'));
                                                        $expire_time = strtotime(Carbon\Carbon::parse($item->end_date)->format('d-M-Y'));
                                                    @endphp 
                                                    @if ($expire_time < $today_time)
                                                        style="color:red  !important;"
                                                    @endif
                                                    >
                                                        Due Date : {{ Carbon\Carbon::parse($item->end_date)->format('d-M-Y') }}
                                                    </p>
                        
                                                </p>
                                                <div class="m-t-20">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        
                                                            <span class="float-right badge badge-pill 
                                                            @switch($item->status)
                                                                @case('incomplete')
                                                                    badge-danger
                                                                    @break
                                                                @default
                                                                    badge-success    
                                                            @endswitch
                                                            " style="text-transform:capitalize;">{{$item->status}}</span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    {{-- end --}}
                                </div>

                                {!! $tasks->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Content Wrapper END -->
@endsection

@section('script')


@endsection