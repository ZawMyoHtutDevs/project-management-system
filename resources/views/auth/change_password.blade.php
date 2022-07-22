<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('change.password', $user_data->id)}}" method="POST">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">စကားဝှက်ပြောင်းရန်</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="">မူလ စကားဝှက်</label>
                    <input type="password" class="form-control" name="current_password" id="" aria-describedby="helpId" placeholder="">
                    
                    </div>

                    <div class="form-group">
                        <label for="">စကားဝှက် အသစ်</label>
                        <input type="password" class="form-control" name="new_password" id="" aria-describedby="helpId" placeholder="">
                        
                    </div>

                    <div class="form-group">
                        <label for="">အတည်ပြု စကားဝှက်</label>
                        <input type="password" class="form-control" name="new_password_confirmation" id="" aria-describedby="helpId" placeholder="">
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >ပြင်ဆင်မည်</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">မလုပ်ပါ</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- show same password and does not match  --}}
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('error') }}
</div>
@endif

{{-- validated error --}}
@if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            @foreach ($errors->all() as $error) {{$error}} <br> @endforeach
        </div>
@endif