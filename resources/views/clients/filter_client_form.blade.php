<!-- Modal -->
<div class="modal modal-right fade " id="filter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="side-modal-wrapper">
                <div class="vertical-align">
                    <div class="table-cell">
                        <form action="{{route('clients.index')}}" method="post">
                            @csrf @method("GET")
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Filter Clients</h5>
                            
                        </div>

                        <div class="modal-body">
                            
                                <div class="form-group">
                                  <label for="">Client Name</label>
                                  <input type="text"
                                    class="form-control" name="name" id="name" value="{{request()->get('name','')}}" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="">Client Email</label>
                                    <input type="text"
                                      class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" value="{{request()->get('email','')}}">
                                </div>

                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date"
                                      class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="" value="{{request()->get('date','')}}">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-default mr-3" href="{{route('clients.index')}}">Reset</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>