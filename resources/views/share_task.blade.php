<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$task->name}} - Task</title>
    {{-- For Seo --}}
    <meta name="description" content="Deadline - {{ Carbon\Carbon::parse($task->end_date)->format('d-M-Y') }}">
    <link rel="canonical" href="{!!Request::url()!!}" />
    
    {{-- Og Meta --}}
    
    <meta property="og:type" content="article" >
    
    
    <meta property="og:title" content="{{ $task->name ?? '' }}" >
    
    
    <meta property="og:description" content="Deadline - {{ Carbon\Carbon::parse($task->end_date)->format('d-M-Y') }}" >
    
    
    <meta property="og:image" content="{{ asset('backend/images/logo/favicon.png') }}" >
    
    
    <meta property="og:url" content="{!!Request::url()!!}" >
    
    
    <meta property="og:site_name" content="PM" >
    
    
    <meta property="og:image:width" content="1000" >
    
    
    <meta property="og:image:height" content="667" >
    <!-- Styles -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

    <style>
        @media screen and (max-width: 480px) {
            .justify-content-between {
                display: block !important;
            }
            .justify-content-between .badge-pill{
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="media align-items-center">
                                
                                <div class="m-l-1">
                                    <h4 class="m-b-0">{{$task->name}}</h4>
                                </div>
                            </div>
                            <div>
                                <span class="badge badge-pill 
                                    @switch($task->status)
                                        @case('incomplete')
                                            badge-danger
                                            @break
                                        @default
                                            badge-success    
                                    @endswitch
                                    " style="text-transform:capitalize;">{{$task->status}}</span>
                                <span class="badge badge-pill badge-info" style="text-transform:capitalize;">{{$task->priority}}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">{{$task->project->name}}</td>
                                    <td>{{ Carbon\Carbon::parse($task->start_date)->format('d-M-Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($task->end_date)->format('d-M-Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <span class="text-dark font-weight-semibold m-r-10 m-b-5">Assigned Member: </span>
                        @foreach ($task->users as $user)
                    
                        <span class="badge badge-pill 
                        @if ($user->utype == 'MAN')
                            badge-warning
                        @elseif ($user->utype == 'ADM')
                            badge-danger
                        @else
                            badge-default
                        @endif
                        ">
                        {{$user->name}}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JS -->
    <script src="{{ asset('backend/js/app.min.js') }}"></script>
</body>
</html>