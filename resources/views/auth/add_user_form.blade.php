<form method="POST" action="{{ route('create.user') }}">
    @csrf
<div class="modal fade" id="adduser">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New User</h5>
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
                            <label for="dob" class="text-md-right">{{ __('Date of Birth') }}</label>
                            
                            
                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">
                            
                            @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="text-md-right">{{ __('Email') }}</label>
                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                            
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                            
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
                        <div class="form-group ">
                            <label for="utype">Role</label>
                            <select name="utype" id="utype" class="form-control">
                                <option value="ADM" selected>Admin</option>
                                <option value="MAN">Manager</option>
                                <option value="EMP">Employee</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        {{-- Department --}}
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id" class="form-control">
                                <option value="" selected>Select Department</option>

                                @foreach ($department_data as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group ">
                    <label for="password" class="text-md-right">{{ __('Password') }}</label>
                    
                    
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                </div>
                
                <div class="form-group ">
                    <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
                    
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    
                </div>
                
            
                {{-- BIO --}}
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea class="form-control" name="bio" id="bio"  rows="2"></textarea>
                    @error('bio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add User</button>
            </div>
        </div>
    </div>
</div>
    
</form>

