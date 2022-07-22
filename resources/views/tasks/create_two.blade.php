@extends('layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Step Two</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('tasks.index')}}">Tasks</a>
            <span class="breadcrumb-item active">New Task</span>
        </nav>
    </div>
</div>
@endsection
@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="card">
            
            <div class="card-body">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf 
                    
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Task Name" value="{{ old('name') }}" autocomplete="Task Name" required>
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}" required>
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="task_category_id">Task Category</label>
                                <select class="select2" name="task_category_id" id="task_category_id">
                                    <option value="">Select</option>
                                    @foreach ($taskCategories as $cat_data)
                                    <option value="{{$cat_data->id}}">{{$cat_data->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-8">
                            <div class="form-group">
                                <label for="users">Assign Members</label>
                                <select class="select2" name="users[]" id="users" multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach ($project->users as $user_data)
                                    <option value="{{$user_data->id}}">{{$user_data->name}}
                                        @if ($user_data->utype == 'MAN')
                                        - (Manager)
                                        @endif
                                    </option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date"
                                class="form-control" name="start_date" id="start_date" aria-describedby="start_date" required value="{{ old('start_date') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Deatline</label>
                                <input type="date"
                                class="form-control" name="end_date" id="end_date" aria-describedby="end_date" value="{{ old('end_date') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Task Status</label>
                                <select class="form-control" name="status" id="status" style="text-transform:capitalize;" required>
                                    @if (old('status'))
                                    <option value="{{old('status')}}">{{old('status')}}</option>
                                    @endif
                                    <option value="incomplete">incomplete</option>
                                    <option value="completed">completed</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label for="priority">Task Priority</label>
                                <select class="form-control" name="priority" id="priority" style="text-transform:capitalize;" required>
                                    @if (old('priority'))
                                    <option value="{{old('priority')}}">{{old('priority')}}</option>
                                    @endif
                                    <option value="high">high</option>
                                    <option value="medium">medium</option>
                                    <option value="low">low</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                    {{-- Description --}}
                    
                    <textarea name="description" id="description" cols="30" rows="10">
                        {!! old('description') !!}
                    </textarea>

                    <hr>
                    
                    <button type='submit' class='btn btn-primary m-r-5 ml-2 float-right' ><span class='m-l-5'>Add Task</span><i class='anticon anticon-right'></i></button>

                    <a href='{{route('tasks.create.one')}}' class='btn btn-default m-r-5 ml-2 float-right' ><i class="anticon anticon-left"></i><span class='m-l-5'>Back</span></a>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="media">
                        
                        <div class="m-l-1">
                            <h5 class="m-b-0">{{$project->name}}</h5>
                        </div>
                    </div>
                    <div class="dropdown dropdown-animated scale-left">
                        <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                            <i class="anticon anticon-setting"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{route('projects.show', $project->id)}}" class="dropdown-item" type="button">
                                <i class="anticon anticon-eye"></i>
                                <span class="m-l-10">View</span>
                            </a>
                            
                        </div>
                    </div>
                </div>
                
                <p class="mt-3">
                    <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Start Date: </span>
                        <span>{{ Carbon\Carbon::parse($project->start_date)->format('d-M-Y') }} </span><br>
                        <span class="font-weight-semibold m-r-10 m-b-5 text-dark">Deadline: </span>
                        <span>{{ Carbon\Carbon::parse($project->end_date)->format('d-M-Y') }} </span>
                </p>
                
                <div class="m-t-20">
                    <div class="d-flex justify-content-between align-items-center">
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
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('script')
<!-- select js -->
<script src="{{asset('backend/vendors/select2/select2.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
    $('.select2').select2();
    
    
    CKEDITOR.replace( 'description',{
        
    } 
    );
    
    
</script>
@endsection