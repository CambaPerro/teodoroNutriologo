<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/lib.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib.css') }}" rel="stylesheet">
    <script>
        window.dataLayer = window.dataLayer || [];
  
        function gtag() {
          dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
      </script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div id="app">
            @guest

            @else
              @if (Auth::user()->estado=='0')
              <principal-component :usuario="{{ Auth::user() }}"></principal-component>
           @else
           @include('header.header')
           <div class="app-body">
           @include('sidebar.sidebar')
           </div>
           @endif
          
            @endguest

            @yield('content')
            @guest

            @else
            @if (Auth::user()->estado=='0')
            
           @else
          </div>
          
            @include('footer.footer')
           @endif
          
            @endguest
    
</body>
</html>
