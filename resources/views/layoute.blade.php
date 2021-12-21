<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('/css/output.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('/css/all.min.css') }}" rel="stylesheet"> --}}
    @yield('head')
</head>

<body>

    @yield('bodyContent')



    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    @yield('script')
</body>

</html>
