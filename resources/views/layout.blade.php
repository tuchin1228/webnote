<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/favor.ico')}}">
    {{-- <link href="{{ asset('/css/output.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('/css/all.min.css') }}" rel="stylesheet"> --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta name="google-site-verification" content="SKKLx68V64e9oHdvZPz95x2-J4kbiecfltFxrxPOyUE" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z8J3CJSD3M"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Z8J3CJSD3M');

    </script>
    @yield('head')
</head>

<body>

    <div class=" lg:px-0 navbar bg-white shadow-md ">
        <div class="style-1 container flex-wrap lg:flex-nowrap items-center mx-auto flex  justify-between">
            <div class=" px-5 w-full bg-white flex justify-between items-center z-20">
                <a class="logo text-2xl md:text-3xl font-semibold cursor-pointer" href="/"><span>Ian's</span>
                    Web全端筆記</a>
                <div class="lg:hidden ">
                    <a href="#" class="nav__trigger "><span class="nav__icon"></span></a>
                    {{-- <i class="fas fa-bars"></i> --}}
                </div>
            </div>
            <div class="pt-5 lg:pt-0 px-5  absolute lg:relative bg-white selection top-0 left-0 w-full transition-all duration-150 z-10
                shadow-md lg:shadow-none
                transform  -translate-y-full lg:top-0 lg:transform-none w-full lg:w-auto lg:flex flex-wrap lg:flex-nowrap
                links
                items-center">
                <a href="https://github.com/tuchin1228"
                    class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b lg:border-none my-1"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">Github</span></a>
                <a href="{{route('Contact')}}" class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b
                    lg:border-none my-1"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">訪客回報</span></a>
                @if (session()->get('token'))
                <a href="{{route('Editor')}}" class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b
                    lg:border-none my-1"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">文章發佈</span></a>
                <a href="{{route('ImageNone')}}"
                    class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b lg:border-none my-1"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">圖片管理</span></a>
                <a href="{{route('TagManage')}}"
                    class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b lg:border-none my-1"><span
                        class="hover:border-b-2 hover:border-black transition-all duration-100">標籤管理</span></a>
                <form action="{{route('Logout')}}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b lg:border-none my-1"><span
                            class="hover:border-b-2 hover:border-black transition-all duration-100">登出</span></button>
                </form>
                @else
                <a href="{{route('Login')}}"
                    class="px-5 lg:whitespace-nowrap block py-2 w-full lg:w-max text-center border-b lg:border-none my-1"><span
                        class=" hover:border-b-2 hover:border-black transition-all duration-100">登入</span></a>
                @endif
                <!-- <a href="" class="px-5 ">連結二</a>
        <a href="" class="px-5">連結三</a> -->
            </div>
        </div>
    </div>
    <div class="content pb-10" style="margin-top: 100px;">
        @yield('bodyContent')
    </div>


    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script>
        $('.nav__trigger').on('click', function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('nav--active');
            $('.selection').toggleClass('translate-y-16 ')

        });
        $(window).scroll(function () {
            console.log($(window).scrollTop(), $(window).width());
            if ($(window).scrollTop() > 10 && $(window).width() > 1024) {
                $('.navbar a.logo').css({
                    'line-height': '70px'
                })
                $('.navbar a.logo').removeClass('text-3xl md:text-4xl')
                $('.navbar  a.logo').addClass('text-xl md:text-3xl')
                // $('.navbar .logo').css({
                //     'font-size': '1.8rem'
                // })
            } else {
                $('.navbar a.logo').css({
                    'line-height': '80px'
                })
                $('.navbar a.logo').removeClass('text-xl md:text-3xl')

                $('.navbar  a.logo').addClass('text-3xl md:text-4xl')
                // $('.navbar .logo').css({
                //     'font-size': '2rem'
                // })
            }
        });

    </script>
    @yield('script')
</body>

</html>
