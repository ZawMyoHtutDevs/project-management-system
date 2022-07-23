
@extends('layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

@endsection
@section('content')



<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Projects</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($projects_data)}}</span>

                <div class="btn-group m-r-10">
                    <a href="{{route('project.style', 'list')}}" id="list-view-btn" type="button" class="btn btn-default btn-icon pt-2
                    @if (session()->get('projectstyle'))
                        @if (session()->get('projectstyle') == 'list')
                        active 
                        @endif
                    @endif
                    "  title="List View">
                        <i class="anticon anticon-ordered-list"></i>
                    </a>
                    <a href="{{route('project.style', 'grid')}}" id="card-view-btn" type="button" class="btn btn-default btn-icon pt-2 
                    @if (session()->get('projectstyle'))
                        @if (session()->get('projectstyle') == 'grid')
                        active 
                        @endif
                    @endif
                    
                    "  title="Card View">
                        <i class="anticon anticon-appstore"></i>
                    </a>
                </div>

                <button class="btn btn-default m-r-5 " data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>
                
                <a href="{{route('projects.create')}}" class="btn btn-primary m-r-5 ml-2 " >
                    <i class="anticon anticon-plus"></i>
                    <span class="m-l-5">New Project</span>
                </a>

            </div>
        </div>
    </div>
</div>        
   
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
{{-- Success message --}}
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('error') }}
</div>
@endif


<div class="container-fluid">
    
    @switch(session()->get('projectstyle'))
        @case('grid')
            @include('projects.style.grid-view')
            @break
        @case('list')
            @include('projects.style.list-view')
            @break
        @default
            @include('projects.style.grid-view')
    @endswitch
    

    


    {!! $projects_data->appends(array("name" => request()->get('name',''), "status" => request()->get('status',''), "start_date" => request()->get('start_date',''), "end_date" => request()->get('end_date',''), "category_id" => request()->get('category_id',''), "end_date_orderby" => request()->get('end_date_orderby',''), "client_id" => request()->get('client_id',''), "priority" => request()->get('priority','') ))->links() !!}
</div>

{{-- Filter Form --}}
@include('projects.filter_form')

@endsection

@section('script')
<!-- select js -->
<script src="{{asset('backend/vendors/select2/select2.min.js')}}"></script>

<script>
    $('.select2').select2();
</script>


@endsection