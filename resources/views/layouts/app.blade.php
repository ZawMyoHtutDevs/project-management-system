<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard | PM</title>
    <link rel="shortcut icon" href="{{ asset('backend/images/logo/favicon.png') }}" type="image/x-icon" />

    <!-- Scripts -->
    
    @yield('style')
    <!-- Styles -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    

</head>
<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            @include('layouts.parts.header')
            <!-- Header END -->

            <!-- Side Nav START -->
            @include('layouts.parts.nav')
            <!-- Side Nav END -->

            
            <!-- Page Container START -->
            <div class="page-container">
                
                
                <!-- Content  -->
                <div class="main-content">
                    @yield('breadcrumb')
                    
                    @yield('content')
                    <!-- Content  -->
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                @include('layouts.parts.footer')
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

            
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>

    

    <!-- Core JS -->
    <script src="{{ asset('backend/js/app.min.js') }}"></script>

    <!-- page js -->
    @yield('script')

</body>
</html>
