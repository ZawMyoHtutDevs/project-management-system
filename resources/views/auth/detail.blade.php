@extends('layouts.app')
@section('style')

@endsection

{{-- Page Action --}}
@section('title', 'Create User')

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$user_data->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('users')}}">Accounts</a>
            <span class="breadcrumb-item active">{{$user_data->name}}</span>
        </nav>
    </div>
    {{-- change Pssword --}}
    <a name="" id="" class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#change_password">Change Password</a>
</div>

@endsection
@section('content')

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif

@include('auth.change_password')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('update.user', $user_data->id) }}">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user_data->name}}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{old('dob') ?? $user_data->dob}}" required autocomplete="dob">
                                @error('dob')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? $user_data->email}}" required autocomplete="email">
                                
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                                
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? $user_data->phone}}" required autocomplete="phone">
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-6">
                            {{-- Role --}}
                            @if (Auth::user()->utype === 'ADM')
                            <div class="form-group">
                                <label for="utype">User Role</label>
                                <select name="utype" id="utype" class="form-control">
                                    <option value="{{$user_data->utype}}" selected>
                                        @switch($user_data->utype)
                                        @case('ADM')
                                        Admin
                                        @break
                                        @case('MAN')
                                        Manager
                                        @break
                                        @default
                                        Employee
                                        @endswitch
                                    </option>
                                    <option value="ADM">Admin</option>
                                    <option value="MAN">Manager</option>
                                    <option value="EMP">Employee</option>
                                </select>
                            </div>
                            @else
                            <div class="alert alert-warning">
                                You can't change Role!
                            </div>
                            @endif
                        </div>
                        <div class="col-6">
                            {{-- Department --}}
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    @if (!empty($user_data->department))
                                    <option value="{{$user_data->department->id}}" selected>{{$user_data->department->name}}</option>
                                    @endif

                                    @foreach ($department_data as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    

                    
                    {{-- Description --}}
                    <div class="form-group mt-4">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" name="bio" id="" rows="2">{{old('bio') ?? $user_data->bio}}</textarea>
                        @error('bio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    
                   
                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('users')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Change') }}
                    </button>
                </div>
                
                
                
            </div>
            
        </div>
    </form>
</div>
</div>

@endsection

@section('script')

@endsection