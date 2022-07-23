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
                            <a class="nav-link" href="{{route('projects.index')}}/{{$project->id}}/tasks">Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('projects.index')}}/{{$project->id}}/comments">Comments</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{route('projects.index')}}/{{$project->id}}/attachments">Attachments</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-1 p-10">
                        <div class="tab-pane fade show active" id="project-details-attachment">
                            
                            <div class="text-md-right mb-2">
                                <button class="btn btn-primary m-r-5 ml-2 " data-toggle="modal" data-target="#commentModel">
                                    <i class="anticon anticon-message"></i>
                                    <span class="m-l-5">Write Comment</span>
                                </button>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach ($comments as $item)
                                <li class="list-group-item p-h-0">
                                    <div class="media m-b-1">
                                        
                                        <div class="media-body m-l-20">
                                            <h6 class="m-b-0">
                                                <a href="" class="text-dark">{{$item->user->name}}</a>
                                            </h6>
                                            <span class="font-size-13 text-gray">{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-3">{!! $item->comment !!}</div>
                                </li>
                                @endforeach
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper END -->

<div class="modal fade" id="commentModel">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal -->
        <form method="POST" action="{{ route('comments.store') }}" >
            @csrf
            <div class="modal-content">
                
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="App\Models\Project">
                        <input type="hidden" name="id" value="{{$project->id}}">
                        <textarea name="comment" class="form-control  @error('comment') is-invalid @enderror" autocomplete="comment" rows="3">{!! old('comment')!!}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
    
    CKEDITOR.replace( 'comment',{
        
    } 
    );
    
</script>
@endsection