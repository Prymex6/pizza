<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('foundation.style', ['types' => 'admin'])


    @yield('style')
</head>

<body class="layout-fixed">
    <div class="wrapper">
        @include('foundation.navigation')

        <div class="content-wrapper" style="min-height: 1223px;">
            @yield('content')
        </div>
    </div>
    @include('foundation.script', ['types' => 'admin'])

    @include('foundation.alert')

    @vite('resources/js/menu.js')
    @yield('script')
</body>

</html>