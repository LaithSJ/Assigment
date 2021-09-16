<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Assigment') }}</title>

        <!-- Styles -->
        <link href="{{ env('APP_URL') }}/assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ env('APP_URL') }}/assets/datepicker/css/bootstrap-datepicker3.standalone.css" rel="stylesheet">
        <link href="{{ env('APP_URL') }}/assets/css/custom.css" rel="stylesheet">
    </head>
    <body>
        @yield('body')
        <script src="{{ env('APP_URL') }}/assets/js/jquery.js"></script>
        <script src="{{ env('APP_URL') }}/assets/js/jquery-ui.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script src="{{ env('APP_URL') }}/datepicker/js/bootstrap-datepicker.min"></script>
        <script src="{{ env('APP_URL') }}/assets/js/custom.js"></script>
    </body>
</html>
