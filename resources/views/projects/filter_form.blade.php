<!-- Modal -->
<div class="modal modal-right fade " id="filter">
  <div class="modal-dialog" >
    <div class="modal-content">
      <form action="{{route('projects.index')}}" method="post">
        @csrf @method("GET")
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Filter Projects</h5>
          
        </div>
        
        <div class="modal-body" style="overflow-y: auto; overflow-x: hidden;">
          
          <div class="form-group">
            <label for="">Project Name</label>
            <input type="text"
            class="form-control" name="name" id="name" value="{{request()->get('name','')}}" aria-describedby="helpId" placeholder="">
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date"
                class="form-control" name="start_date" id="start_date" aria-describedby="helpId" placeholder="" value="{{request()->get('start_date','')}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Deadline</label>
                <input type="date"
                class="form-control" name="end_date" id="end_date" aria-describedby="helpId" placeholder="" value="{{request()->get('end_date','')}}">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="end_date_orderby">Sort with Deadline</label>
            <select class="form-control" name="end_date_orderby" id="end_date_orderby" style="text-transform:capitalize;">
              
              @if (request()->get('end_date_orderby') == "asc")
              <option value="{{request()->get('status','')}}">ascending</option>
              @elseif(request()->get('end_date_orderby') == "desc")
              <option value="{{request()->get('status','')}}">descending</option>
              @else
              <option value="">Select Order</option>
              @endif
              <option value="asc">ascending</option>
              <option value="desc">descending</option>
            </select>
          </div>
          
          
          <div class="form-group">
            <label for="category_id">Project Category</label>
            <select class="select2" name="category_id" id="category_id">
              <option value="">Select</option>
              @foreach ($categories as $cat_data)
              <option value="{{$cat_data->id}}">{{$cat_data->name}}</option>
              @endforeach
              
            </select>
          </div>
          
          <div class="form-group">
            <label for="client_id">Client</label>
            <select class="select2" name="client_id" id="client_id">
              <option value="">Select</option>
              @foreach ($clients as $cli_data)
              <option value="{{$cli_data->id}}">{{$cli_data->name}}</option>
              @endforeach
              
            </select>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                <label for="status">Project Status</label>
                <select class="form-control" name="status" id="status" style="text-transform:capitalize;">
                  @if (request()->get('status'))
                  <option value="{{request()->get('status','')}}">{{request()->get('status','')}}</option>
                  @else
                  <option value="">Select Status</option>
                  @endif
                  <option value="not started">not started</option>
                  <option value="in progress">in progress</option>
                  <option value="on hold">on hold</option>
                  <option value="cancled">cancled</option>
                  <option value="finished">finished</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              
              <div class="form-group">
                <label for="priority">Project Priority</label>
                <select class="form-control" name="priority" id="priority" style="text-transform:capitalize;">
                  @if (request()->get('priority'))
                  <option value="{{request()->get('priority','')}}">{{request()->get('priority','')}}</option>
                  @else
                  <option value="">Select Priority</option>
                  @endif
                  <option value="high">high</option>
                  <option value="medium">medium</option>
                  <option value="low">low</option>
                </select>
              </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer" style="position: sticky; background-color: white;">
          <a type="button" class="btn btn-default mr-3" href="{{route('projects.index')}}">Reset</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      </form>
    </div>
  </div>
</div>