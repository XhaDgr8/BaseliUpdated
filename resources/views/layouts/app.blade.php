<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body>

        <main id="app">
            @include('inc.navbar')
            @yield('content')
            @include('inc.footer')
        </main>

        <!-- JavaScript and dependencies -->
        <script src="{{asset('js/app.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
        <script src="https://printjs-4de6.kxcdn.com/print.min.css"></script>
    </body>
</html>
