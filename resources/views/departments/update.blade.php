@extends('layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$department_data->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Department</span>
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

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Update Department') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('departments.update', $department_data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Apple" value="{{ old('name') ?? $department_data->name  }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>
                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">{{ old('description') ?? $department_data->description }}</textarea>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection