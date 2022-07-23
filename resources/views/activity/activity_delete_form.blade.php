<form method="POST" action="{{ route('activity.delete.date') }}">
    @csrf
<div class="modal fade" id="deleteActivity">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addclient">Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="text-md-right">Start</label>
                            
                            
                            <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start">
                            
                            @error('start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="end">End</label>
                            <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required autocomplete="end">
                            @error('end')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default mr-3" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
    
</form>

