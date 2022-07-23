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
                                " style="text-transform:capitalize;">{{$task->status}}
                            </span>
                            <span class="badge badge-pill badge-info" style="text-transform:capitalize;">
                                {{$task->priority}}
                            </span>
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
                            ">
                            {{$user->name}}
                            </span>
                        @endforeach
                        </div>
                        <div class="m-t-10">
                            <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Start Date: </span>
                            <span>{{ Carbon\Carbon::parse($task->start_date)->format('d-M-Y') }} </span>
                            <br>
                            <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Deadline: </span>
                            <span>{{ Carbon\Carbon::parse($task->end_date)->format('d-M-Y') }} </span>
                        </div>
                    </div>
                </div>
                <div class="m-t-30">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link "  href="{{route('tasks.show', $task->id)}}">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tasks.index')}}/{{$task->id}}/timers">Timers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tasks.index')}}/{{$task->id}}/comments">Comments</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="{{route('tasks.index')}}/{{$task->id}}/attachments">Attachments</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15 p-25">
                        <div class="tab-pane fade show active" id="task-details-attachment">
    
                            {{-- Success message --}}
                            @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ Session::get('success') }}
                            </div>
                            @endif
    
                            <small>Max upload file size is 50MB.</small>
                            <div class="m-3">
                                <div id="file" class="dropzone"></div>
                            </div>
                            
                            @foreach ($attachments as $item)
                            <div class="file" style="min-width: 200px;">
                                <div class="media align-items-center">
                                    @if ($item->extension == "png" || $item->extension == "jpg" || $item->extension == "jpeg" || $item->extension == "gif" )
                                    <div class="avatar avatar-icon avatar-blue rounded m-r-15">
                                        <i class="anticon anticon-file-image font-size-20"></i>
                                    </div>
                                    
                                    @elseif ($item->extension == "docx" || $item->extension == "txt")
                                    <div class="avatar avatar-icon avatar-cyan rounded m-r-15">
                                        <i class="anticon anticon-file-text font-size-20"></i>
                                    </div>
                                    
                                    @elseif ($item->extension == "pdf")
                                    <div class="avatar avatar-icon avatar-volcano rounded m-r-15">
                                        <i class="anticon anticon-file-pdf font-size-20"></i>
                                    </div>
                                    
                                    @else
                                    <div class="avatar avatar-icon avatar-gold rounded m-r-15">
                                        <i class="anticon anticon-file-exclamation font-size-20"></i>
                                    </div>
                                    
                                    @endif
                                    
                                    
                                    <div>
                                        <h6 class="mb-0">{{$item->asset}}</h6>
                                        <span class="font-size-13 text-muted">
                                            @php
                                            if ($item->size >= 1073741824) {
                                                $mbSize = number_format($item->size / 1073741824, 2) . ' GB';
                                            } elseif ($item->size >= 1048576) {
                                                $mbSize = number_format($item->size / 1048576, 2) . ' MB';
                                            } elseif ($item->size >= 1024) {
                                                $mbSize = number_format($item->size / 1024, 2) . ' KB';
                                            } elseif ($item->size > 1) {
                                                $mbSize = $item->size . ' bytes';
                                            } elseif ($item->size == 1) {
                                                $mbSize = '1 byte';
                                            } else {
                                                $mbSize = '0 bytes';
                                            }
                                            @endphp
                                            {{$mbSize}}
                                        </span>
                                        <span class="float-right">
                                                <a href="{{asset('backend/images/tasks/'. $item->asset)}}" class="badge badge-pill badge-blue" download>Downlaod</a>
                                                
                                                <span class="badge badge-pill badge-red" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">Delete</span>
                                                
                                                <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('attachment.destroy', $item->id)}}" >
                                                    @csrf @method('DELETE')
                                                </form>
                                                
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script>
    var drop = new Dropzone('#file', {
        createImageThumbnails: true,
        addRemoveLinks: true,
        url: "{{ route('attachment.storeTask', $task->id) }}",
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        }
    });
    
    // $('#myTab a[href="#project-details-comments"]').tab('show')
</script>

@endsection