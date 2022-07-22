@extends('layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$client->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('clients.index')}}">Clients</a>
            <span class="breadcrumb-item active">Update Client</span>
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
            
            
            <div class="card-body">
                <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    
                    <div class="form-group">
                        <label for="">Update Image</label>
                        
                        <img class="img-fluid rounded shadow" src="
                            @if (!empty($client->asset))
                                {{asset('backend/images/clients/'. $client->asset)}}
                            @else
                                {{asset('backend/images/client_logo.png')}}
                            @endif
                        " style="max-width: 100px; margin-bottom: 10px;" alt="">
                        
                        <input type="file" name="asset" id="asset" class="form-control  @error('asset') is-invalid @enderror" placeholder="apple" value="{{ old('asset') }}" autocomplete="asset" >
                        @error('asset')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Apple" value="{{ old('name') ?? $client->name }}" autocomplete="name" >
                        
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email" class="text-md-right">{{ __('Email') }}</label>
                                
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $client->email }}" autocomplete="email">
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="website" class="text-md-right">{{ __('Website') }}</label>
                                
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') ?? $client->website }}" autocomplete="website">
                                
                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="address" class="text-md-right">{{ __('Address') }}</label>
                        
                        
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $client->address }}" autocomplete="address">
                        
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
    
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contact_person" class="text-md-right">{{ __('Contact Person') }}</label>
                                
                                
                                <input id="contact_person" type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') ?? $client->contact_person }}" autocomplete="contact_person">
                                
                                @error('contact_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                                
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $client->phone }}" autocomplete="phone">
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">{{ old('description') ?? $client->description }}</textarea>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection