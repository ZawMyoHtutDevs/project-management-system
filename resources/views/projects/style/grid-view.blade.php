<div id="card-view">
    <div class="row">

        @foreach ($projects_data as $item)
        <div class="col-md-3 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="media">
                            
                            <div class="m-l-1">
                                <h5 class="m-b-0">{{$item->name}}</h5>
                                {{-- need to update --}}
                                <span class="text-muted font-size-13">{{count($item->tasks)}} Tasks</span>
                            </div>
                        </div>
                        <div class="dropdown dropdown-animated scale-left">
                            <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                                <i class="anticon anticon-setting"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{route('projects.show', $item->id)}}" class="dropdown-item" type="button">
                                    <i class="anticon anticon-eye"></i>
                                    <span class="m-l-10">View</span>
                                </a>
                                @manager()
                                <a href="{{route('projects.edit', $item->id)}}" class="dropdown-item" type="button">
                                    <i class="anticon anticon-edit"></i>
                                    <span class="m-l-10">Edit</span>
                                </a>
                                <button class="dropdown-item" type="button" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                    <i class="anticon anticon-delete"></i>
                                    <span class="m-l-10">Delete</span>
                                </button>
                                <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('projects.destroy', $item->id)}}" >
                                    @csrf @method('DELETE')
                                </form>
                                @endmanager
                            </div>
                        </div>
                    </div>
                    <p class="m-t-25">
                        <div>
                            @foreach ($item->users as $user)
                            <a class="m-r-5" href="javascript:void(0);" data-toggle="tooltip" title="{{$user->name}}">
                                <div class="avatar avatar-image avatar-sm"
                                @if ($user->utype == 'MAN')
                                style="border: 2px solid gold;"
                                @elseif ($user->utype == 'ADM')
                                style="border: 2px solid red;"
                                @endif
                                >
                                    <img src="{{asset('backend/images/user.png')}}" alt="{{$user->name}}">
                                </div>
                            </a>
                            @endforeach
                            
                        </div>
                    </p>
                    <div class="m-t-30">
                        <div class="d-flex justify-content-between">
                            @php
                            if(count($item->tasks)){
                                $countPercent = count($item->tasks->where('status', '=', 'completed')) / count($item->tasks);
                                $percentage = $countPercent * 100;
                            }
                            @endphp

                            <span class="font-weight-semibold">Progress</span>
                            <span class="font-weight-semibold">{{$percentage ?? '0'}}%</span>
                        </div>
                        <div class="progress progress-sm m-t-10">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$percentage ?? '0'}}%"></div>
                        </div>
                    </div>
                    <div class="m-t-20">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                
                                <span class="badge badge-pill 
                                @switch($item->status)
                                    @case('not started')
                                        badge-default
                                        @break
                                    @case('in progress')
                                        badge-info
                                        @break
                                    @case('on hold')
                                        badge-warning
                                        @break
                                    @case('cancled')
                                        badge-dange
                                        @break
                                    @default
                                        badge-success    
                                @endswitch
                                " style="text-transform:capitalize;">{{$item->status}}</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        {{-- end --}}
    </div>
</div>