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
    <h2 class="header-title">Accounts List</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Accounts</span>
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

<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('Accounts') }} 
                <button class="btn btn-primary m-r-5 float-right" data-toggle="modal" data-target="#adduser" >Add <i class="anticon anticon-plus-square"></i></button>
            </div>
            
            <div class="card-body">
                <table id="data-table" class="table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users_data as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                @switch($data->utype)
                                    @case('ADM')
                                    <span class="badge badge-danger">Admin</span>
                                        @break
                                    @case('MAN')
                                    <span class="badge badge-warning">Manager</span>
                                        @break
                                    @default
                                    <span class="badge badge-info">Employee</span>
                                @endswitch
                                
                            </td>
                            <td>
                                @if (!empty($data->department))
                                    {{$data->department->name}}
                                @endif
                            </td>
                            <td>
                                
                                {{-- Edit and View --}}
                                <a href="{{route('users.detail', $data->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                    <i class="anticon anticon-edit"></i>
                                </a>
                                {{-- Delete User --}}
                                @if (Auth::user()->id != $data->id)
                                
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" type="submit" onclick="confirm('Are you sure you want to delete this item?'); event.preventDefault(); document.getElementById('delete-form{{$data->id}}').submit(); ">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                                <form id="delete-form{{$data->id}}" method="POST" action="{{route('delete.user', $data->id)}}" >
                                    @csrf
                                </form>
                                @endif
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Form --}}
@include('auth.add_user_form')

@endsection

@section('script')
<!-- page js -->
<script src="{{ asset('backend/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    
    
    $('#data-table').DataTable();
    
    
</script>
@endsection