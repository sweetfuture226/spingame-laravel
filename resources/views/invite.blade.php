<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>FAQ's | Spin Game</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/auth.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/loader.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/swal/sweetalert2.min.css')}}">
        <style media="screen">
            @media only screen
            and (device-width : 375px)
            and (device-height : 812px)
            and (-webkit-device-pixel-ratio : 3) {
                .home_container > .circle-img-container {
                    margin-top: 75px;
                }
            }
        </style>
        <script src="{{asset('plugins/jquery/jquery-3.3.1.min.js')}}" charset="utf-8"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}" charset="utf-8"></script>
        <script src="{{asset('plugins/swal/sweetalert2.min.js')}}" charset="utf-8"></script>

        <script src="{{asset('js/sidebar.js')}}" charset="utf-8"></script>
    </head>
    <body>
        <audio id="audio_bgm" loop>
            <source src="{{asset('music/bgm.mpeg')}}">
        </audio>
        <div class="main-container home-screen">
            <div class="container background-spin-img-container" style="position: relative;">
                <div class="row navbar-container">
                    <span class="username_nav">Invite Friends</span>
                    <span class="choosegame_nav">Choose your game</span>
                    <div class="hamburger-btn-container" id="sidebar_click_btn">
                        <img src="{{asset('images/hamburger_btn.png')}}" class="open_btn" alt="">
                        <img src="{{asset('images/hamburger_close_btn.png')}}" class="close_btn" alt="">
                    </div>
                </div>
                <div class="row sidebar-container" id="sidebar_container">
                    <div class="overlay"></div>
                    <div class="menu-container" style='-webkit-overflow-scrolling:touch;'>
                        <ul>
                            <li> <a href="{{route('dashboard')}}">dashboard</a> </li>
                            <li> <a href="{{url('game/lifestyle')}}">lifestyle</a> </li>
                            <li> <a href="{{url('game/electronics')}}">electronics</a> </li>
                            <li> <a href="{{url('game/eating')}}">eating and drinking</a> </li>
                            <li> <a href="{{route('buytokenview')}}">buy tokens</a> </li>
                            <li > <a style="text-transform: none" href="{{route('faq')}}">FAQ's</a> </li>
                            <li> <a href="{{route('contact')}}">Contact Us</a> </li>
                            <li> <a href="{{route('contact')}}">Invite Friends</a> </li>
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <style>
                    .certain-container::before{
                        background-image:none
                    }
                    .circle-img-container > img {
                        width:40%;
                    }
                    @media (max-width: 767px){
                        .circle-img-container > img {
                            width: 100%;
                        }
                    }

                </style>
                <script>
                    $(document).ready(function(){
                    $('.username_nav').css('text-transform', 'none');
                    $('.username_nav').html("Invite Friends");
                    })</script>
                <div class="row certain-container" >
                    <!--<img src="{{asset('images/left_certain.png')}}" class="left_blank_img" alt="">
                    <img src="{{asset('images/right_certain.png')}}" class="right_blank_img" alt="">-->
                    <div class="sound-icon-container">
                        <a href="#" onclick="bgm_on(1)" style="display: inline-block;cursor: pointer;"><img src="{{asset('images/sound_icon.png')}}" alt=""></a>
                    </div>
                    <div class="home_container" style='-webkit-overflow-scrolling:touch;'>
                        <div class="col-md-8" style="margin:4rem auto">
                            <form action="{{ route('process') }}" method="post">
                                {{ csrf_field() }}
                                <input type="email" name="email" />
                                <button type="submit">Send invite</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        <script src="{{asset('js/global.js')}}" charset="utf-8"></script>
        <script type="text/javascript">
                window.onload = function () {
                setTimeout(function () {
                $('.loading-container').fadeOut('slow');
                }, 500);
                }
        </script>
    </body>
</html>

         
  
