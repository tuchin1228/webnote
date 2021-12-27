<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="{{ asset('/css/output.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('/css/all.min.css') }}" rel="stylesheet"> --}}
    @yield('head')
</head>

<body>

    <div class="navbar bg-white shadow-md">
        <div class="container items-center mx-auto flex  justify-between">
            <a class="logo font-semibold cursor-pointer" href="/"><span>Ian</span> 前後端筆記</a>
            <div class="links flex items-center">
                <a href="https://github.com/tuchin1228" class="px-5">Github</a>
                @if (session()->get('token'))
                <a href="{{route('Editor')}}" class="px-5"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">文章發佈</span></a>
                <a href="{{route('ImageNone')}}" class="px-5"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">圖片管理</span></a>
                <form action="{{route('Logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="px-5"><span
                            class="hover:border-b-2 hover:border-black transition-all duration-100">登出</span></button>
                </form>
                @else
                <a href="{{route('Login')}}" class="px-5"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">登入</span></a>
                @endif
                <!-- <a href="" class="px-5">連結二</a>
        <a href="" class="px-5">連結三</a> -->
            </div>
        </div>
    </div>
    <div class="content pb-10" style="margin-top: 100px;">
        @yield('bodyContent')
    </div>


    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script>
        $(window).scroll(function () {
            console.log($(window).scrollTop());
            if ($(window).scrollTop() > 200) {
                $('.navbar .links a').css({
                    'line-height': '65px'
                })
                $('.navbar .logo').css({
                    'font-size': '1.8rem'
                })
            } else {
                $('.navbar .links a').css({
                    'line-height': '80px'
                })
                $('.navbar .logo').css({
                    'font-size': '2rem'
                })
            }
        });

    </script>
    @yield('script')
</body>

</html>
