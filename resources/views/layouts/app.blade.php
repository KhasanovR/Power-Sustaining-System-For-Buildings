<!doctype html>
<html ng-app="dbApp" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="shortcut icon" href="/storage/images/logo1.png">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <title>{{ config('app.name', 'DBADPROJTEAM21') }}</title>
        {{--<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">--}}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        {{-- <script rel="text/javascript" src="{{asset('js/angular.js')}}"></script> --}}
    </head>
    <body>
        @yield('script')
        <script src={{asset('js/cart.js')}}></script>
        @include('inc.navbar')
        <div class="container-fluid">
            <div class="mt-3">
                @include('inc.messages')
                @yield('content')
            </div>
        </div>
    </body>
    {{--<script src="{{asset('js/app.js')}}"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular.min.js"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src={{asset('js/index.js')}}></script>


</html>
