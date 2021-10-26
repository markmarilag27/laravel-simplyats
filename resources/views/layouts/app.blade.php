<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="my-20">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ url()->current() }}">
    <title>{{ config('app.name') }} -@stack('title')</title>

    @stack('head_style')

    @if(app()->environment('local'))
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ mix("js/app.js") }}" defer></script>
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset("js/app.js") }}" defer></script>
    @endif
</head>

<body class="bg-gray-50">
    @include('components.flash_message')
    {{-- end flash message --}}
    @include('partials.top_navigation')
    {{-- end top navigation --}}
    @yield('content')
</body>

</html>
