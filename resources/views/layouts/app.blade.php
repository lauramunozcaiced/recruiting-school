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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--Livewire -->
    @livewireStyles()
    @livewireScripts()
</head>
<body @auth class="{{Auth::user()->role}}" @endauth>
    <div id="app" class="app">
        <x-layout.menu></x-layout.menu>
        <main id="main">
            <div class="dashboard app__dashboard row justify-content-center h-100">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">                   
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
<script src="https://player.vimeo.com/api/player.js"></script>
</html>
