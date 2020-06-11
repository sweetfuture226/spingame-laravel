<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>@yield('page_title') | Spin Game</title>
        <meta name="google-site-verification" content="TUmmPtaQnt3okYWDaMejEY-_U_yErtm5dtfia5BUJk8" />
        <meta name="keywords" content="simple spin game,best spin game of nigeria," />
        <meta name="description" content="Best spin game site for Nigeria.For a chance to win 150k and other fantastic prizes sign up and play">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}"> -->
        <!-- <link rel="stylesheet" href="{{asset('plugins/swal/sweetalert2.min.css')}}"> -->
        <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
        <!-- <link rel="stylesheet" href="{{asset('css/auth.css')}}"> -->
        <!-- <link rel="stylesheet" href="{{asset('css/loader.css')}}"> -->
        <script src="{{asset('plugins/jquery/jquery-3.3.1.min.js')}}" charset="utf-8"></script>
        <script src="{{asset('plugins/swal/sweetalert2.min.js')}}" charset="utf-8"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}" charset="utf-8"></script>
        <script src="{{asset('plugins/validator/jquery.validate.min.js')}}" charset="utf-8"></script>
        

         <link rel="stylesheet" href="{{asset('html/plugins/bootstrap/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('html/plugins/swal/sweetalert2.min.css')}}" />
        <link rel="stylesheet" href="{{asset('html/css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('html/css/auth.css')}}" />
        <link rel="stylesheet" href="{{asset('html/css/loader.css')}}" />
        <!-- <script src="{{asset('html/plugins/jquery/jquery-3.3.1.min.js')}} charset="utf-8"></script>
        <script src="{{asset('html/plugins/swal/sweetalert2.min.js')}} charset="utf-8"></script>
        <script src="{{asset('html/plugins/bootstrap/js/bootstrap.min.js')}} charset="utf-8"></script>
        <script src="{{asset('html/plugins/validator/jquery.validate.min.js')}} charset="utf-8"></script>
         -->
        @yield('page_style')
    </head>
    <body>
        <audio id="audio_bgm" loop>
            <source src="{{asset('html/music/bgm.mpeg')}}" />
            <source src="{{asset('html/music/bgm.mp3')}}" />
        </audio>
        @yield('content')
        <div class="loading-container">
            <div class="spin-container">
                <img
                    src="{{asset('html/images/try.png')}}"
                    class="spin-bg-image"
                    style="     left: 10px;   width: 100%;top:-50px"
                    alt=""
                />
                <img src="{{asset('html/images/turn_bg_spin.png')}}" class="spin-bg-image" alt="" />
                <img src="{{asset('html/images/turning_spin.png')}}" class="spin-turnning-image" alt="" />
                <img src="{{asset('html/images/spin_pin.png')}}" class="spin-pin-image" alt="" />
                <img
                    src="{{asset('html/images/spin-content.png')}}"
                    class="spin-bg-image"
                    style="top:270px;    left: 37px;    width: 70%;"
                    alt=""
                />
            </div>
        </div>

        <script src="{{asset('js/auth.js')}}" charset="utf-8"></script>
        <script src="{{asset('js/global.js')}}" charset="utf-8"></script>
        <script type="text/javascript">
            window.onload = function() {
                setTimeout(function() {
                    $(".loading-container").fadeOut("slow");
                }, 100);
            };
        </script>
    </body>
</html>
