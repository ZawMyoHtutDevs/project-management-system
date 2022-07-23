<div class="card" id="list-view">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Tasks</th>
                        <th>Members</th>
                        <th>Progress</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects_data as $item)
                    <tr>
                        <td>
                            <div class="media align-items-center">
                                
                                <div class="">
                                    <h5 class="m-b-0">{{$item->name}}</h5>
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
                        </td>
                        <td>
                            <span>{{count($item->tasks)}} Tasks</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
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
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @php
                            if(count($item->tasks)){
                                $countPercent = count($item->tasks->where('status', '=', 'completed')) / count($item->tasks);
                                $percentage = $countPercent * 100;
                            }
                            @endphp
                            <div class="progress progress-sm w-100 m-b-0">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$percentage ?? '0'}}%"></div>
                            </div>
                            <div class="m-l-10">
                                {{$percentage ?? '0'}}%
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
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
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</div>