@extends('layouts.app')
@section('style')
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
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
                                <a class="nav-link" href="{{route('projects.index')}}/{{$project->id}}/tasks">Tasks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('projects.index')}}/{{$project->id}}/comments">Comments</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('projects.index')}}/{{$project->id}}/attachments">Attachments</a>
                            </li>
                        </ul>
                        <div class="tab-content m-t-15 p-25">
                            <div class="tab-pane fade show active" id="project-details-attachment">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-h-0">
                                        <div class="media m-b-15">
                                            <div class="avatar avatar-image">
                                                <img src="assets/images/avatars/thumb-8.jpg" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">
                                                    <a href="" class="text-dark">Lillian Stone</a>
                                                </h6>
                                                <span class="font-size-13 text-gray">28th Jul 2018</span>
                                            </div>
                                        </div>
                                        <p>The palatable sensation we lovingly refer to as The Cheeseburger has a distinguished and illustrious history. It was born from humble roots, only to rise to well-seasoned greatness.</p>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="media m-b-15">
                                            <div class="avatar avatar-image">
                                                <img src="assets/images/avatars/thumb-9.jpg" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">
                                                    <a href="" class="text-dark">Victor Terry</a>
                                                </h6>
                                                <span class="font-size-13 text-gray">28th Jul 2018</span>
                                            </div>
                                        </div>
                                        <p>The palatable sensation we lovingly refer to as The Cheeseburger has a distinguished and illustrious history. It was born from humble roots, only to rise to well-seasoned greatness.</p>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="media m-b-15">
                                            <div class="avatar avatar-image">
                                                <img src="assets/images/avatars/thumb-10.jpg" alt="">
                                            </div>
                                            <div class="media-body m-l-20">
                                                <h6 class="m-b-0">
                                                    <a href="" class="text-dark">Wilma Young</a>
                                                </h6>
                                                <span class="font-size-13 text-gray">28th Jul 2018</span>
                                            </div>
                                        </div>
                                        <p>The palatable sensation we lovingly refer to as The Cheeseburger has a distinguished and illustrious history. It was born from humble roots, only to rise to well-seasoned greatness.</p>
                                    </li>
                                </ul>
                                
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