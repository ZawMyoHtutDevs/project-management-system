<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Project Management System</title>
    <link rel="shortcut icon" href="{{ asset('backend/images/logo/favicon.png') }}" type="image/x-icon" />
    
    <!-- Styles -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet">
    

</head>
<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('{{asset('backend/images/others/login-3.png')}}')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="{{asset('backend/images/logo/logo-fold.png')}}">
                                        <h2 class="m-b-0">Sign In</h2>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="Email">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <a class="float-right font-size-13 text-muted" href="{{ route('password.request') }}">Forget Password?</a>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>

                                        <div class="form-group mt-3">
                                            <div class="d-block">
                                                
                                                <button class="btn btn-primary" style="float: right">Sign In</button>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2022 41Dev</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

  
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    
    <script src="{{ asset('backend/js/app.min.js') }}"></script>

</body>
</html>
