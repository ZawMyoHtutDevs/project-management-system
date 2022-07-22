
@extends('layouts.app')
@section('style')
<!-- page css -->
<link href="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

<style>
    #data-table_filter input{
        max-width: 200px !important;
    }
</style>
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Task Category List</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('tasks.index')}}">Tasks</a>
            <span class="breadcrumb-item active">Categories</span>
        </nav>
    </div>
</div>
@endsection
@section('content')

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

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header mt-3 h4">{{ __('Add New Category') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('task-categories.store') }}" >
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Web Creation" value="{{ old('name') }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror"  value="{{ old('description') }}" autocomplete="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            
            
            <div class="card-body">
                <table id="data-table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tasks</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($taskCategory as $item)
                            <tr>
                                
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    {{count($item->tasks)}} - tasks
                                </td>
                                <td>
                                    {{$item->department->name}}
                                </td>
                                <td>
                                    
                                    {{-- Edit and View --}}
                                    <a href="{{route('task-categories.edit', $item->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                        <i class="anticon anticon-edit"></i>
                                    </a>
                                    
                                    
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                    <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('task-categories.destroy', $item->id)}}" >
                                        @csrf @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- page js -->
<script src="{{ asset('backend/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    

$('#data-table').DataTable();


</script>
@endsection