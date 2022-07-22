@extends('layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Step One</h2>
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

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            
            <div class="card-body">
                
                <div class="form-group">
                    <label for="project_id">Projects</label>
                    <select class="select2" name="project_id" id="project_id" onchange="GetId()">
                        <option value="">Select Project</option>
                        @foreach ($projects as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                        
                    </select>
                </div>
                
                <hr>
                
                <div id="submitButton">
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- select js -->
<script src="{{asset('backend/vendors/select2/select2.min.js')}}"></script>
<script>
    $('.select2').select2();

    window.onload = function() {
        document.getElementById('submitButton').innerHTML = "<button disabled='' class='btn btn-primary m-r-5 ml-2 float-right' id='nextStep'><span class='m-l-5'>Next Step</span><i class='anticon anticon-right'></i></button>"
    };

    function GetId(){
        $projectId = document.getElementById('project_id').value;
        if($projectId == ''){
            document.getElementById('submitButton').innerHTML = "<button disabled='' class='btn btn-primary m-r-5 ml-2 float-right' id='nextStep'><span class='m-l-5'>Next Step</span><i class='anticon anticon-right'></i></button>"
        }else{
        document.getElementById('submitButton').innerHTML = "<a href='{{url('dashboard/tasks/create/step/2')}}/"+$projectId+"' class='btn btn-primary m-r-5 ml-2 float-right' id='nextStep'><span class='m-l-5'>Next Step</span><i class='anticon anticon-right'></i></a>"
        }
    }
    
    
</script>
@endsection