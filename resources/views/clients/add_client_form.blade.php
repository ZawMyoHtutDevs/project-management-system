<form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="addclient">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addclient">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="text-md-right">{{ __('Name') }}</label>
                            
                            
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" name="asset" id="asset" class="form-control  @error('asset') is-invalid @enderror" placeholder="apple" value="{{ old('asset') }}" autocomplete="asset" >
                            @error('asset')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="text-md-right">{{ __('Email') }}</label>
                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                            
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
                            
                            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" autocomplete="website">
                            
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
                    
                    
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address">
                    
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
                            
                            
                            <input id="contact_person" type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') }}" autocomplete="contact_person">
                            
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
                            
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">
                            
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
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description"  rows="2">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default mr-3" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Client</button>
            </div>
        </div>
    </div>
</div>
    
</form>

