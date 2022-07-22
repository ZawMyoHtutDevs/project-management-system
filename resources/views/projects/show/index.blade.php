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
                                <a class="nav-link active"  href="{{route('projects.show', $project->id)}}">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('projects.index')}}/{{$project->id}}/tasks">Tasks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('projects.index')}}/{{$project->id}}/comments">Comments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('projects.index')}}/{{$project->id}}/attachments">Attachments</a>
                            </li>
                        </ul>
                        <div class="tab-content m-t-15 p-25">
                            <div class="tab-pane fade show active" id="project-details">
                                <p>
                                    {{$project->description}}
                                </p>

                                <hr>
                                @if (!empty($project->client))
                                <div class="col-md-5 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="m-t-10 text-center">
                                                <div class="avatar avatar-image" style="height: 100px; width: 100px;">
                                                    <img src="
                                                    @if (!empty($project->client->asset))
                                                    {{asset('backend/images/clients/'. $project->client->asset)}}
                                                    @else
                                                    {{asset('backend/images/client_logo.png')}}
                                                    @endif
                                                    
                                                    " alt="{{$project->client->name}}">
                                                </div>
                                                
                                                <div class="dropdown dropdown-animated " style="
                                                display: inline;
                                                position: absolute;
                                                float: right;
                                                right: 20px;
                                                top: 10px;
                                                ">
                                                    <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                                                        <i class="anticon anticon-setting"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a href="{{route('clients.show', $project->client->id)}}" class="dropdown-item" type="button">
                                                            <i class="anticon anticon-eye"></i>
                                                            <span class="m-l-10">View</span>
                                                        </a>
                                                        @manager()
                                                        <a href="{{route('clients.edit', $project->client->id)}}" class="dropdown-item" type="button">
                                                            <i class="anticon anticon-edit"></i>
                                                            <span class="m-l-10">Edit</span>
                                                        </a>
                                                        <button class="dropdown-item" type="button" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$project->client->id}}').submit(); }">
                                                            <i class="anticon anticon-delete"></i>
                                                            <span class="m-l-10">Delete</span>
                                                        </button>
                                                        <form style="display: none;" id="delete-form{{$project->client->id}}" method="POST" action="{{route('clients.destroy', $project->client->id)}}" >
                                                            @csrf @method('DELETE')
                                                        </form>
                                                        @endmanager
                                                    </div>
                                                </div>
                                                <h4 class="m-t-30">{{$project->client->name}}</h4>
                                                <p>{{$project->client->email}}</p>
                                                <small>{{count($project->client->projects)}} Projects</small>
                                            </div>
                                            <div class="text-center m-t-30">
                                                <a href="tel:{{$project->client->phone}}" class="btn btn-primary btn-tone">
                                                    <i class="anticon anticon-mail"></i>
                                                    <span class="m-l-5">Call Now</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

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