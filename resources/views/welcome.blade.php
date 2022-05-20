<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Laravel</title>

        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" /> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
    </head>


    <body class="antialiased">
        <div id="app">
            <app-component></app-component>
        </div>


        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
