<div id="card-view">
    <div class="row">

        @foreach ($tasks as $item)
        <div class="col-md-3 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="media">
                            
                            <div class="m-l-1">
                                <h5 class="m-b-0">{{$item->name}}</h5>
                                {{-- need to update --}}
                                <span class="text-muted font-size-13">{{$item->project->name}}</span>
                            </div>
                        </div>
                        <div class="dropdown dropdown-animated scale-left">
                            <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
                                <i class="anticon anticon-setting"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{route('tasks.show', $item->id)}}" class="dropdown-item" type="button">
                                    <i class="anticon anticon-eye"></i>
                                    <span class="m-l-10">View</span>
                                </a>
                                <button class="dropdown-item" type="button" onclick="
                                navigator.clipboard.writeText('{{route('share.task', $item->id)}}')
                                alert('Copied Link!')
                                ">
                                    <i class="anticon anticon-link"></i>
                                    <span class="m-l-10">Copy Link</span>
                                </button>
                                <a href="{{route('tasks.change.status', $item->id)}}" class="dropdown-item" type="button">
                                    <i class="anticon anticon-check"></i>
                                    <span class="m-l-10">Update Status</span>
                                </a>
                                @manager()
                                <a href="{{route('tasks.edit', $item->id)}}" class="dropdown-item" type="button">
                                    <i class="anticon anticon-edit"></i>
                                    <span class="m-l-10">Edit</span>
                                </a>
                                <button class="dropdown-item" type="button" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
                                    <i class="anticon anticon-delete"></i>
                                    <span class="m-l-10">Delete</span>
                                </button>
                                <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('tasks.destroy', $item->id)}}" >
                                    @csrf @method('DELETE')
                                </form>
                                @endmanager
                            </div>
                        </div>
                    </div>
                    <p class="m-t-10">
                        
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
                        <br>
                        <p class="text-success"
                        @php
                            $today_time = strtotime(Carbon\Carbon::now()->format('d-M-Y'));
                            $expire_time = strtotime(Carbon\Carbon::parse($item->end_date)->format('d-M-Y'));
                        @endphp 
                        @if ($expire_time < $today_time)
                            style="color:red !important;"
                        @endif
                        >
                            Due Date : {{ Carbon\Carbon::parse($item->end_date)->format('d-M-Y') }}
                        </p>

                    </p>
                    <div class="m-t-20">
                        <div class="d-flex justify-content-between align-items-center">
                            
                                <span class="float-right badge badge-pill 
                                @switch($item->status)
                                    @case('incomplete')
                                        badge-danger
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
        @endforeach
        
        {{-- end --}}
    </div>
</div>