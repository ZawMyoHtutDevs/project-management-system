@extends('layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media align-items-center">
                                
                                <div class="m-l-1">
                                    <h4 class="m-b-0">{{$task->name}}</h4>
                                    <p>{{$task->taskCategory->name}}</p>
                                </div>
                            </div>
                            <div>
                                <span class="badge badge-pill 
                                    @switch($task->status)
                                        @case('incomplete')
                                            badge-danger
                                            @break
                                        @default
                                            badge-success    
                                    @endswitch
                                    " style="text-transform:capitalize;">{{$task->status}}</span>
                                <span class="badge badge-pill badge-info" style="text-transform:capitalize;">{{$task->priority}}</span>
                            </div>
                        </div>
                        
                        <div class="d-md-flex m-t-30 align-items-center justify-content-between">
                            <div class="d-flex align-items-center m-t-10">
                                <span class="text-dark font-weight-semibold m-r-10 m-b-5">Team: </span>
                                @foreach ($task->users as $user)
                            
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
                                <span>{{ Carbon\Carbon::parse($task->start_date)->format('d-M-Y') }} </span><br>
                                <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Deadline: </span>
                                <span>{{ Carbon\Carbon::parse($task->end_date)->format('d-M-Y') }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-30">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('tasks.show', $task->id)}}">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('tasks.index')}}/{{$task->id}}/timers">Timers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('tasks.index')}}/{{$task->id}}/comments">Comments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('tasks.index')}}/{{$task->id}}/attachments">Attachments</a>
                            </li>
                        </ul>
                        <div class="tab-content m-t-15 p-25">
                            <div class="tab-pane fade show active" id="task-timers">
                                <p>
                                    {!!$task->description!!}
                                </p>

                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h3>Project</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="media">
                                
                                <div class="m-l-1">
                                    <h5 class="m-b-0">{{$task->project->name}}</h5>
                                </div>
                            </div>
                            <div class="dropdown dropdown-animated scale-left">
                                <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{route('projects.show', $task->project->id)}}" class="dropdown-item" type="button">
                                        <i class="anticon anticon-eye"></i>
                                        <span class="m-l-10">View</span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <p class="mt-3">
                            <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Start Date: </span>
                                <span>{{ Carbon\Carbon::parse($task->project->start_date)->format('d-M-Y') }} </span><br>
                                <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Deadline: </span>
                                <span>{{ Carbon\Carbon::parse($task->project->end_date)->format('d-M-Y') }} </span>
                        </p>
                        
                        <div class="m-t-20">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    
                                    <span class="badge badge-pill 
                                    @switch($task->project->status)
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
                                    " style="text-transform:capitalize;">{{$task->project->status}}</span>
                                </div>
                                
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