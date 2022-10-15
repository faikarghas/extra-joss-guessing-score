<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>{{  config('app.name') }} - @yield('title')</title>
   

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
     href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
     rel="stylesheet"
   />

   <!-- todo: css/script -->
   <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/fonts/boxicons.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/core.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/theme-default.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/my-auth/css/auth.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/demo.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/js/perfect-scrollbar/perfect-scrollbar.css') }}">
   {{-- <script src="{{ asset('vendor/my-dashboard/js/helpers.js') }}">
   <script src="{{ asset('vendor/my-dashboard/js/config.js') }}"> --}}
</head>
<body>
   @yield('content')                  
   <!-- todo: script -->
   <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}">
   <script src="{{ asset('vendor/my-dashboard/js/popper/popper.js') }}">   
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
   <script src="{{ asset('vendor/my-dashboard/js/perfect-scrollbar/perfect-scrollbar.js') }}">  
   <script src="{{ asset('vendor/my-dashboard/js/menu.js') }}"> 
   <script src="{{ asset('vendor/my-dashboard/js/main.js') }}"> 
</body>
</html>