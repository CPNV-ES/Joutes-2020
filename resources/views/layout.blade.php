<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('/favicon.ico') }}" rel="icon" data-n-head="true" type="image/png">

    <link href="{{ asset('/font-awesome/css/all.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/mdbootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/mdbootstrap/css/mdb.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet" type="text/css"/>
    @stack('styles')
</head>

<body>
@yield('content')

<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset('/mdbootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('/mdbootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/mdbootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/mdbootstrap/js/mdb.min.js') }}"></script>
@stack('scripts')
</body>
</html>
