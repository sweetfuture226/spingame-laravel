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
                    <span class="username_nav">FAQ's</span>
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
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <li> <a href="{{route('contact')}}">Contact Us</a> </li>
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
                    $('.username_nav').html("FAQ's");
                    })</script>
                <div class="row certain-container" >
                    <!--<img src="{{asset('images/left_certain.png')}}" class="left_blank_img" alt="">
                    <img src="{{asset('images/right_certain.png')}}" class="right_blank_img" alt="">-->
                    <div class="sound-icon-container">
                        <a href="#" onclick="bgm_on(1)" style="display: inline-block;cursor: pointer;"><img src="{{asset('images/sound_icon.png')}}" alt=""></a>
                    </div>
                    <div class="home_container" style='-webkit-overflow-scrolling:touch;'>
                        <div class="col-md-8" style="margin:0 auto">
                            <!--<div style="margin-top:10%;font-size: 18pt;color: #FBAA18;font-weight: bold; ">FAQ's</div>-->
                            <p style="font-size: 16pt;margin-top:5%;color: #FFF;font-weight: bold;">How can I claim my prize?</p>
                            <p style="font-size: 12pt;margin-top:2%;margin-left:5%;color: #FFF;">After you have won an email will be sent to you confirming that you are the winner and you will be informed on how to redeem your prize. Please note it may take up to 21 days for you to receive electronic prizes.</p>
                            <p style="font-size: 16pt;margin-top:5%;color: #FFF;font-weight: bold;">Why are no games worth <span>&#189;</span> a token?</p>
                            <p style="font-size: 12pt;margin-top:2%;margin-left:5%;color: #FFF;">You should only ever purchase a half token if you have won a <span>&#189;</span> token as a prize after spinning the wheel. Buying a half token when you have won a <span>&#189;</span> token will give you <b>1 TOKEN </b> to enable you to play a game.
                            <p style="font-size: 16pt;margin-top:5%;color: #FFF;font-weight: bold;">Can I exchange my voucher for cash?</p>
                            <p style="font-size: 12pt;margin-top:2%;margin-left:5%;color: #FFF;">No. Any vouchers won on Thrift Gift will not be exchanged for their cash value.</p>
                            <p style="font-size: 16pt;margin-top:5%;color: #FFF;font-weight: bold;">Are my tokens refundable?</p>

                            <p style="font-size: 12pt;margin-top:2%;margin-left:5%;color: #FFF;">No. All purchases of tokens are final and non-refundable.</p>
                            <p style="font-size: 16pt;margin-top:5%;color: #FFF;font-weight: bold;">For any enquiries email us at <a style="color: #FFF;" href="mailto:ThriftGift@usibaservices.co.uk">ThriftGift@usibaservices.co.uk</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loading-container">
            <div class="spin-container">
                <img src="{{asset('images/turn_bg_spin.png')}}" class="spin-bg-image" alt="">
                <img src="{{asset('images/turning_spin.png')}}" class="spin-turnning-image" alt="">
                <img src="{{asset('images/spin_pin.png')}}" class="spin-pin-image" alt="">
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
