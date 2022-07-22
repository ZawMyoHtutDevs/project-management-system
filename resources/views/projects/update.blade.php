@extends('layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
<h2 class="header-title">{{$project->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('projects.index')}}">Projects</a>
            <span class="breadcrumb-item active">Update Project</span>
        </nav>
    </div>
</div>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            
            <div class="card-body">
                <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    

                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Project Name" value="{{ old('name') ?? $project->name }}" autocomplete="Project Name" required>
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category_id">Project Category</label>
                                <select class="select2" name="category_id" id="category_id">
                                    <option value="{{$project->category->id ?? ''}}" checked>{{$project->category->name ?? 'Select'}}</option>
                                    @foreach ($categories as $cat_data)
                                    <option value="{{$cat_data->id}}">{{$cat_data->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_id">Client</label>
                                <select class="select2" name="client_id" id="client_id">
                                    <option value="{{$project->client->id ?? ''}}" checked>{{$project->category->name ?? 'Select'}}</option>
                                    @foreach ($clients as $cli_data)
                                        <option value="{{$cli_data->id}}">{{$cli_data->name}}</option>
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
                                class="form-control" name="start_date" id="start_date" aria-describedby="start_date" required value="{{ old('start_date') ?? $project->start_date }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Deatline</label>
                                <input type="date"
                                  class="form-control" name="end_date" id="end_date" aria-describedby="end_date" value="{{ old('end_date') ?? $project->end_date }}">
                              </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="users">Project Members</label><br/>

                        <select class="select2 mt-3" name="users[]" id="users" multiple="multiple" >
                            
                            

                            @foreach ($users as $user_data)
                                <option value="{{$user_data->id}}"
                                    @foreach ($project->users as $data)
                                        @if ($data->id == $user_data->id)
                                            selected
                                        @endif
                                    @endforeach
                                    
                                    >{{$user_data->name}}
                                @if ($user_data->utype == 'MAN')
                                    - (Manager)
                                @endif
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Project Status</label>
                                <select class="form-control" name="status" id="status" style="text-transform:capitalize;" required>
                                    <option value="{{$project->status}}" selected>{{$project->status}}</option>
                                    <option value="not started">not started</option>
                                    <option value="in progress">in progress</option>
                                    <option value="on hold">on hold</option>
                                    <option value="cancled">cancled</option>
                                    <option value="finished">finished</option>
                                </select>
                              </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="priority">Project Priority</label>
                                <select class="form-control" name="priority" id="priority" style="text-transform:capitalize;" required>
                                    <option value="{{$project->priority}}" selected>{{$project->priority}}</option>
                                    <option value="high">high</option>
                                    <option value="medium">medium</option>
                                    <option value="low">low</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">
                            {!! old('description') ?? $project->description !!}</textarea>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary float-right">Update Project</button>
                </form>
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