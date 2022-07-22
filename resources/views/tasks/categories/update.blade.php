@extends('layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$taskCategory->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('tasks.index')}}">Tasks</a>
            <span class="breadcrumb-item active">Category</span>
        </nav>
    </div>
</div>
@endsection
@section('content')


<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Update Category') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('task-categories.update', $taskCategory->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Apple" value="{{ $taskCategory->name ?? old('name') }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>

                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">{{ $taskCategory->description ?? old('description') }}</textarea>
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