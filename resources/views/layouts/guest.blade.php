<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
{{--    @vite(['resources/сss/app.scss', 'resources/js/app.js'])--}}
</head>
<body class="font-sans antialiased theme-dark">
<div class="min-h-full">
{{--    @include('layouts.header')--}}
    <div class=" overflow-hidden">
        @yield('content')
    </div>
{{--    @include('layouts.footer')--}}
</div>
</body>
</html>
