
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
                    <h3>Activity History</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($notifications)}}</span>
                
                
                
                <button class="btn btn-warning m-r-5 ml-2 " data-toggle="modal" data-target="#deleteActivity" >
                    <i class="anticon anticon-delete"></i>
                    <span class="m-l-5">Delete By Date</span>
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
    
    <div class="row">
        @foreach ($notifications as $item)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <li class="timeline-item pb-0">
                            <div class="timeline-item-head">
                                <div class="avatar avatar-icon bg-white">
                                    @if ($item->read_at != '')
                                    <i class="anticon anticon-issues-close font-size-22 text-success"></i>
                                    @else
                                    <i class="anticon anticon-info-circle font-size-22 text-warning"></i>
                                    @endif
                                    

                                    
                                </div>
                            </div>
                            <div class="timeline-item-content">
                                <div class="m-l-10">
                                    <p class="m-b-0">
                                        @php
                                            $body = json_decode($item->data, true);
                                        @endphp
                                        <span class="m-l-5">{{$body['data']}}</span>
                                    </p>
                                    <span class="text-muted font-size-13">
                                        <i class="anticon anticon-clock-circle"></i>
                                        <span class="m-l-5">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                    </span>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <br>
    
    
    {!! $notifications->appends(array("created_at" => request()->get('created_at','') ))->links() !!}
</div>


@include('activity.activity_delete_form')

@endsection

@section('script')
<!-- select js -->
<script src="{{asset('backend/vendors/select2/select2.min.js')}}"></script>

<script>
    $('.select2').select2();
</script>


@endsection