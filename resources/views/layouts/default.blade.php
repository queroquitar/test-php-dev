<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(!Auth::guest())
            <meta name="api-host" content="{{ env('API_HOST') }}">
            <meta name="jwt-token" content="{{ Auth::user()->jwt }}">
        @endif

        <title>Laravel</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('css')
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    @include('layouts.menu')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')
</html>
