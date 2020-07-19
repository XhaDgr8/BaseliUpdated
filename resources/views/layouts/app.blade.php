<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- JavaScript and dependencies -->
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body>

        <main id="app">
            @include('inc.navbar')
            @yield('content')
            @include('inc.footer')
        </main>
           
    </body>
</html>
