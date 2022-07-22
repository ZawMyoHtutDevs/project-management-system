
@extends('layouts.app')
@section('style')

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
                    <h3>Clients</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{$clients_data->total()}}</span>

                <button class="btn btn-default m-r-5 " data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>

                <button class="btn btn-primary m-r-5 ml-2 " data-toggle="modal" data-target="#addclient" >
                    <i class="anticon anticon-plus"></i>
                    <span class="m-l-5">New Client</span>
                </button>
                
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
    <div id="card-view">
        <div class="row">

            @foreach ($clients_data as $item)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="m-t-10 text-center">
                            <div class="avatar avatar-image" style="height: 100px; width: 100px;">
                                <img src="
                                @if (!empty($item->asset))
                                {{asset('backend/images/clients/'. $item->asset)}}
                                @else
                                {{asset('backend/images/client_logo.png')}}
                                @endif
                                
                                " alt="{{$item->name}}">
                            </div>
                            
                            <div class="dropdown dropdown-animated " style="
                            display: inline;
                            position: absolute;
                            float: right;
                            right: 20px;
                            top: 10px;
                            ">
                                <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{route('clients.show', $item->id)}}" class="dropdown-item" type="button">
                                        <i class="anticon anticon-eye"></i>
                                        <span class="m-l-10">View</span>
                                    </a>
                                    <a href="{{route('clients.edit', $item->id)}}" class="dropdown-item" type="button">
                                        <i class="anticon anticon-edit"></i>
                                        <span class="m-l-10">Edit</span>
                                    </a>
                                    <button class="dropdown-item" type="button" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                        <i class="anticon anticon-delete"></i>
                                        <span class="m-l-10">Delete</span>
                                    </button>
                                    <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('clients.destroy', $item->id)}}" >
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </div>
                            <h4 class="m-t-30">{{$item->name}}</h4>
                            <p>{{$item->email}}</p>
                            <small>{{count($item->projects)}} Projects</small>
                        </div>
                        <div class="text-center m-t-30">
                            <a href="tel:{{$item->phone}}" class="btn btn-primary btn-tone">
                                <i class="anticon anticon-mail"></i>
                                <span class="m-l-5">Call Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            {{-- end --}}
        </div>
    </div>
    {!! $clients_data->appends(array("name" => request()->get('name',''), "email" => request()->get('email',''), "date" => request()->get('date','') ))->links() !!}
</div>

{{-- Add Form --}}
@include('clients.add_client_form')

{{-- Filter Form --}}
@include('clients.filter_client_form')
@endsection

@section('script')

@if ($errors->any())
<script type="text/javascript">
    $(window).on('load', function() {
        $('#addclient').modal('show');
    });
</script>
@endif

@endsection