<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- For Widgets --}}
{{--    <link href="{{ asset('css/theme.bundle.css') }}" rel="stylesheet" id="stylesheetLight"/>--}}
{{--    <link href="{{ asset('css/admin.bundle.css') }}" rel="stylesheet">--}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body id="app">

</body>

</html>


