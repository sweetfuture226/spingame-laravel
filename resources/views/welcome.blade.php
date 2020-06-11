@extends('layouts.authMaster')
@section('page_title') Welcome @endsection
@section('page_style')
  <style>
        .login,
        .signup {
            font-size: 18px;
            margin-right: 10px;
            margin-top: 4px;
        }
        @media (max-width: 360px) and (max-height: 640px) {
            .login,
            .signup {
                font-size: 6px!important;
                margin-right: 5px!important;
                margin-top: 2px!important;
            }
        }
        @media (max-width: 767px) {.login, .signup {
            font-size: 9px;
            margin-right: 10px;
            margin-top: 4px;
        }}
    </style>
@endsection
@section('content')

        <div class="main-container">
            <div class="container background-spin-img-container" style="position: relative;">
                <div class="row navbar-container nav-bar">
                    <div class="header-botton">
                        <img src="{{asset('html/images/module5.png')}}" class="how_to" alt="" />
                        <img src="{{asset('html/images/faq.png')}}" class="faq" alt="" />
                        <a href="{{route('login')}}" ><button type="submit" class="auth-button login">LOGIN</button></a>

                        <a href="{{route('register')}}" ><button type="submit" class="auth-button signup">SIGN UP</button></a>
                    </div>

                    <!--<span>THRIFT GIFT</span>-->
                </div>
                <div class="row certain-container remove-before">
                    <div class="header-help">
                        <!-- <p class="auth-button">LOG IN</p> -->
                        <img src="{{asset('html/images/module6.png')}}" class="help-img d-md-block" alt="" />
                    </div>
                    <img src="{{asset('html/images/left_certain.png')}}" class="left_blank_img" alt="" />
                    <img src="{{asset('html/images/right_certain.png')}}" class="right_blank_img" alt="" />
                    <div class="sound-icon-container">
                        <a href="#" onclick="bgm_on(false)" style="display: inline-block;cursor: pointer;">
                            <img src="{{asset('html/images/sound_icon.png')}}" alt="" />
                        </a>
                    </div>
                    <div
                        class="col-md-12 auth-container background-spin-container"
                        style="-webkit-overflow-scrolling:touch;"
                    >
                        <div class="title-img-container">
                            <marquee>( Scrolling message )</marquee>
                        </div>
                        <div class="logo-img-container">
                            <span class="spin">
                                SPIN THE WHELL TO TRY YOUR COUSE
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4 slide-img">
                                <img src="{{asset('html/images/module1.png')}}" class="slide-section d-md-block" alt="" />
                                <img class="mySlides w3-animate-left" src="{{asset('html/images/img_rr_01.jpg')}}" />
                                <img class="mySlides w3-animate-left" src="{{asset('html/images/img_rr_03.jpg')}}" />
                                <img class="mySlides w3-animate-left" src="{{asset('html/images/img_rr_04.jpg')}}" />
                                <script>
                                    var myIndex = 0;
                                    carousel();

                                    function carousel() {
                                        var i;
                                        var x = document.getElementsByClassName("mySlides");
                                        for (i = 0; i < x.length; i++) {
                                            x[i].style.display = "none";
                                        }
                                        myIndex++;
                                        if (myIndex > x.length) {
                                            myIndex = 1;
                                        }
                                        x[myIndex - 1].style.display = "block";
                                        setTimeout(carousel, 2000); // Change image every 2 seconds
                                    }
                                </script>
                            </div>
                            <div class="col-md-4 sec-img">
                                <img src="{{asset('html/images/module2.png')}}" class="img-section d-md-block" alt="" />
                                <img class=" w3-animate-left secimg" src="{{asset('html/images/img_rr_01.jpg')}}" />
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-3 table-d">
                                <table>
                                    <tr>
                                        <th>THIS WEEK WINNERS</th>
                                    </tr>
                                    <tr>
                                        <td>----------</td>
                                    </tr>
                                    <tr>
                                        <td>----------</td>
                                    </tr>
                                    <tr>
                                        <td>----------</td>
                                    </tr>
                                    <tr>
                                        <td>----------</td>
                                    </tr>
                                    <tr>
                                        <td>----------</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-7 footer-grup">
                                <div class="row footer-div">
                                    <div class="col-md-4 fooerspin1">
                                        <img src="{{asset('html/images/module11.png')}}" class="spin-m d-md-block" alt="" />
                                    </div>
                                    <div class="col-md-1 fooerspin2"></div>
                                    <div class="col-md-5 spin-right fooerspin3">
                                        <div class="row section-footer">
                                            <img
                                                src="{{asset('html/images/module15.png')}}"
                                                class=" d-md-block footer-signup"
                                                alt=""
                                            />
                                        </div>

                                        <div class="row buy-token">
                                            <img src="{{asset('html/images/module16.png')}}" class=" d-md-block " alt="" />
                                        </div>
                                        <div class="row footer-spin">
                                            <img src="{{asset('html/images/module17.png')}}" class=" d-md-block " alt="" />
                                        </div>
                                        <div class="row play-demo">
                                            <a href="{{Route('demo')}}"><img src="{{asset('html/images/module9.png')}}" class=" d-md-block " alt="" /></a>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="col-md-2 fooerspin4"></div>
                                </div>

                                <div class="row socialicon">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 socials">
                                        <div class="row">
                                            <div class="col-md-4 social-botton button1">
                                                <img src="{{asset('html/images/module12.png')}}" class=" d-md-block" alt="" />
                                            </div>
                                            <div class="col-md-4 social-botton button2">
                                                <img src="{{asset('html/images/module14.png')}}" class=" d-md-block" alt="" />
                                            </div>
                                            <div class="col-md-4 social-botton button3">
                                                <img src="{{asset('html/images/module13.png')}}" class=" d-md-block" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>

                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row footer-row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="row footer-info">
                                            <div class="col-md-5 footer-content">
                                                <img src="{{asset('html/images/module20.png')}}" alt="" />
                                            </div>
                                            <div class="col-md-1 flag">
                                                <img src="{{asset('html/images/module19.png')}}" alt="" />
                                            </div>
                                            <div class="col-md-2 footer-content2">
                                                <img
                                                    src="{{asset('html/images/module21.png')}}"
                                                    class="footer-content-img2"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="col-md-1 flag flag_last">
                                                <img src="{{asset('html/images/module19.png')}}" alt="" />
                                            </div>
                                            <div class="col-md-3 footer-content1">
                                                <img src="{{asset('html/images/module18.png')}}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {});
                </script>
            </div>
        </div>

@endsection
