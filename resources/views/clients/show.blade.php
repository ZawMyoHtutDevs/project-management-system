
@extends('layouts.app')
@section('style')
<!-- page css -->
<link href="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$client->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('clients.index')}}">Clients</a>
            <span class="breadcrumb-item active">Client Detail</span>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-md-flex align-items-center">
                    <div class="text-center text-sm-left ">
                        <div class="avatar avatar-image" style="width: 150px; height:150px">
                            <img src="
                            @if (!empty($client->asset))
                                {{asset('backend/images/clients/'. $client->asset)}}
                            @else
                                {{asset('backend/images/client_logo.png')}}
                            @endif
                            " alt="">
                        </div>
                    </div>
                    <div class="text-center text-sm-left m-v-15 p-l-30">
                        <h2 class="m-b-5">{{$client->name}}</h2>
                        <p class="text-dark m-b-20">{{$client->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="d-md-block d-none border-left col-1"></div>
                    <div class="col">
                        <ul class="list-unstyled m-t-10">
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                    <span>Email: </span> 
                                </p>
                                <p class="col font-weight-semibold"> {{$client->email}}</p>
                            </li>
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-user"></i>
                                    <span>Client: </span> 
                                </p>
                                <p class="col font-weight-semibold"> {{$client->contact_person}}</p>
                            </li>
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                    <span>Phone: </span> 
                                </p>
                                <p class="col font-weight-semibold"> {{$client->phone}}</p>
                            </li>
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-global"></i>
                                    <span>Website: </span> 
                                </p>
                                <p class="col font-weight-semibold"> {{$client->website}}</p>
                            </li>
                            <li class="row">
                                <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                    <span>Location: </span> 
                                </p>
                                <p class="col font-weight-semibold"> {{$client->address}}</p>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Proejcts --}}
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">{{$client->name}}'s Projects</h5>
        
        <table id="data-table" class="table table-inverse">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($client->projects as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->category->name}}
                        </td>
                        <td>
                            {{-- need to edit --}}
                            <span class="badge badge-warning">
                                {{$item->status}}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-default">
                                {{ Carbon\Carbon::parse($item->updated_at)->format('d-M-Y') }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            
            
        </table>
        
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