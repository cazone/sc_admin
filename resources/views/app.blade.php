<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" class="no-js">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
            <!-- project css file  -->
        <link rel="stylesheet" href="{{ asset("assets/css/al.style.min.css")}}">

        <!-- project layout css file -->
        <link rel="stylesheet" href="{{ asset("assets/css/layout.d.min.css")}}">

        <!-- Scripts -->

        @routes
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>


    </head>
    <body>
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
        <script src="{{ asset("assets/bundles/libscripts.bundle.js")}}""></script>

<!-- Plugin Js -->

<!-- Jquery Page Js -->
    <script src="{{ asset("assets/js/template.js")}}"></script>

    </body>
        <!-- Jquery Core Js -->

</html>
