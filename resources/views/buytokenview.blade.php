@extends('layouts.appMain')
@section('page_title') Buy Token @endsection
@section('page_style')
<style>
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            .subtitle{
                font-size:23pt;
                font-weight:bold;
                margin-top:15px;
                margin-left:auto;
                margin-right:auto;
                width: 100%;
                color:#FFF;
                overflow: hidden;

                left: 0;
            }
            .spin_background {
                content: "";
                display: block;
                background: url({{asset('images/spin_circle_half.png')}}) center no-repeat;
                background-size: contain;
                position: absolute;
                width: 500px;
                height: 250px;
                bottom: 0;
                left: calc(50% - 250px);
                z-index: 1;
            }

            @media (max-width: 767px) {
                .spin_background {
                    width: 90%;
                    left: calc(50% - 45%);
                    bottom: -7%;
                }
            }

            .buytoken_container {
                margin: 0 auto;
                margin-top: 60px;
            }

            .buytoken_box {
                width: 415px;
                height: 320px;
                margin: 62px 20px 0px 20px;
                float: left;
                background: url({{asset('images/buytoken_bg_1px.png')}});
                background-size: auto;
                background-repeat: repeat-x;
                border-radius: 20px;
                background-position: center;
            }

            .buytoken_title {
                width: 280px;
                margin: 0 auto;
                margin-top: 14px;
                text-align: center;
                font-size: 25px;
                font-weight: bold;
                color: #fff;
            }

            .buytoken_input_container {
                width: 260px;
                margin: 0 auto;
                margin-top: 40px;
                text-align: center;
                font-weight: bold;
                color: #fff;
                font-size: 25px;
            }

            .buytoken_input {
                width: 50%;
                margin: 8px 0;
                padding: 3px 5px;
                font-weight: bold;
                color: #fff;
                box-sizing: border-box;
                border: solid 3px #fff;
                background: transparent;
            }

            .buytoken_minplus {
                width: 78px;
                margin: 5px;
                padding-top: 10px;
                cursor: pointer;
                font-size: 35pt;
            }

            .butoken_price {
                width: 50%;
                margin: 0 auto;
            }

            .buy_token_btn {
                width: 200px;
                height: 60px;
                background: url({{asset('images/buy_button.png')}}) no-repeat;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                border-radius: 10px;
                background-position: center;
                cursor: pointer;
                padding: 0;
                border: none;
            }

            @media (max-width: 767px) {
                .buy_token_btn {
                    width: 150px;
                    height: 50px;
                    border-radius: 3px;
                }

                .buytoken_container {
                    width: 80%;
                    margin: 0 auto;
                    margin-top: 30px;
                }

                .buytoken_box {
                    width: 100%;
                    height: 150px;
                    margin: 0 auto;
                    margin-top: 50px;
                    background: url({{asset('images/buytoken_bg_1px.png')}});
                    background-size: auto;
                    background-repeat: repeat-x;
                    border-radius: 10px;
                    background-position: center;
                }

                .buytoken_box:first-child {
                    margin-top: 120px;
                }

                .buytoken_title {
                    width: 280px;
                    margin: 0 auto;
                    margin-top: -20px;
                    text-align: center;
                    font-size: 16pt;
                    font-weight: bold;
                    color: #fff;
                }

                .buytoken_input_container {
                    width: 260px;
                    margin: 0 auto;
                    margin-top: 10px;
                    text-align: center;
                    font-weight: bold;
                    color: #fff;
                    font-size: 25px;
                }

                .buytoken_input {
                    width: 50%;
                    margin: 8px 0;
                    padding: 3px 5px;
                    font-weight: bold;
                    color: #fff;
                    box-sizing: border-box;
                    border: solid 3px #fff;
                    background: transparent;
                }

                .buytoken_minplus {
                    width: 78px;
                    margin: 5px;
                    padding-top: 10px;
                    cursor: pointer;
                    font-size: 35pt;
                }

                .butoken_price {
                    width: 50%;
                    margin: 0 auto;
                }
            }

            .style-title-container {
                top: 15px;
            }

            @media (max-width: 767px) {
                .style-title-container {
                    top: 15px;
                }
            }

            .certain-container::before {
                content: "";
                display: block;
                background: url({{asset('images/spin_circle_.png')}}) center no-repeat;
                background-size: contain;
                position: absolute;
                width: 500px;
                height: 500px;
                bottom: -300px;
                left: calc(50% - 250px);
                z-index: 1;
            }

            @media (max-width: 360px) and (max-height: 640px) {
                .text-top {
                    text-align: center;
                    top: 31px;
                }

                .onetoken_price {
                    margin-top: 0px !important;
                }

                .buytoken_container {
                    width: 80%;
                    margin: 0 auto;
                    margin-top: 40px;
                }

                .text-top > img {
                    width: 55%;
                }

                .buytoken_title {
                    width: 280px;
                    margin: 0 auto;
                    margin-top: -11px;
                    text-align: center;
                    font-size: 10pt;
                    font-weight: bold;
                    color: #fff;
                }

                .buytoken_input_container > div {
                    margin-top: -27px;
                }

                .buy_token_prize {
                    font-size: 10px;
                    margin-top: 0 !important;
                }

                .buy_text {
                    margin-top: -120px;
                    font-size: 0.7rem;
                    text-align: center;
                }

                .halftoken_price {
                    margin-top: -14px !important;
                }

                .buytoken_input {
                    width: 50%;
                    margin: 8px 0;
                    padding: 0px 3px;
                    font-weight: bold;
                    color: #fff;
                    box-sizing: border-box;
                    border: solid 2px #fff;
                    background: transparent;
                }

                .buytoken_box {
                    width: 100%;
                    height: 110px;
                    margin: 0 auto;
                    margin-top: 42px;
                    background: url({{asset('images/buytoken_bg_1px.png')}});
                    background-size: auto;
                    background-repeat: repeat-x;
                    border-radius: 10px;
                    background-position: center;
                }
            }

            /* @media (max-width: 991px) {
                    .buytoken_container {
                        text-align: center;
                    }
                    .text-top {
                        top: 25px;
                    }
                    .buytoken_box {
                        width: 412px;
                        height: 212px;
                        margin: 30px 20px -7px 154px;
                        float: left;
                        background: url({{asset('images/buytoken_bg_1px.png')}});
                        background-size: auto;
                        background-repeat: repeat-x;
                        border-radius: 20px;
                        background-position: center;
                    }
                    .buytoken_title {
                        width: 278px;
                        margin: 0 auto;
                        margin-top: 7px;
                        text-align: center;
                        font-size: 20px;
                        font-weight: bold;
                        color: #fff;
                    }
                    .buytoken_input_container {
                        width: 260px;
                        margin: 0 auto;
                        margin-top: 9px;
                        text-align: center;
                        font-weight: bold;
                        color: #fff;
                        font-size: 25px;
                    }
                } */
        </style>
@endsection
@section('content')
<div class="main-container home-screen">
            <div class="container background-spin-img-container" style="position: relative;">
                <div class="row navbar-container">
                    <div class="hamburger-btn-container" id="sidebar_click_btn">
                        <img src="{{asset('html/images/hamburger_btn.png')}}" class="open_btn" alt="" />
                        <img src="{{asset('html/images/hamburger_close_btn.png')}}" class="close_btn" alt="" />
                    </div>
                    <span class="username_nav" style="text-align: center;">
                        <img src="{{asset('html/images/buy_token.png')}}" class="title_buy_token" alt="" />
                    </span>

                    <span class="choosegame_nav">Choose your game</span>
                   
                </div>
                <div class="row sidebar-container" id="sidebar_container">
                    <div class="overlay"></div>
                    <div class="menu-container" style="-webkit-overflow-scrolling:touch;">
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

                <div class="row certain-container">
                    <div class="sound-icon-container">
                        <a href="#" onclick="bgm_on(true)" style="display: inline-block;cursor: pointer;">
                            <img src="{{asset('html/images/sound_icon.png')}}" alt="" />
                        </a>
                    </div>

                    <div class="buytoken_container">
                        <div class="col-md-12 text-top">
                            <div class="subtitle" >Available Tokens: <span style="font-weight: bold;">{{$token_count}}</span></div>
                        </div>
                        <div class="buytoken_box">
                            <div class="buytoken_title">
                                BUY HALF TOKENS
                            </div>
                            <div class="buytoken_input_container">
                                <div>
                                    <span class="buytoken_minplus" id="halftoken_min">-</span>
                                    <input class="buytoken_input" id="halftoken_count" value="1" type="number" />
                                    <span class="buytoken_minplus" id="halftoken_plus">+</span>
                                </div>
                                <div class="halftoken_price">
                                    ₦{{config('constants.token_price')/2}}
                                </div>
                                
                            </div>
                        </div>
                        <div class="buytoken_box">
                            <div class="buytoken_title">
                                BUY 1 TOKENS
                            </div>
                            <div class="buytoken_input_container">
                                <div>
                                    <span class="buytoken_minplus" id="onetoken_min">-</span>
                                    <input class="buytoken_input" id="onetoken_count" value="1" type="number" />
                                    <span class="buytoken_minplus" id="onetoken_plus">+</span>
                                </div>
                                <div class="onetoken_price">
                                    ₦{{config('constants.token_price')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 buy_text">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="text-align:center">
                                <button class="buy_token_btn" onclick="buy_token()"></button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <!-- <div class="spin_background"></div> -->
                </div>
                <?php 
                    $pay_info=config('constants.pay_info');
                    ?>
                <script type="text/javascript" src="{{$pay_info['pay_js_cdn']}}"></script>
                <script
                    type="text/javascript"
                    src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"
                ></script>
                <script>
                    var halftoken_count = 1;
                    var onetoken_count = 1;
                    var halftoken_price = 100;
                    var onetoken_price = 200;
                    $(document).ready(function() {
                        $("#halftoken_min").click(function() {
                            if ($("#halftoken_count").val() > 0) {
                                halftoken_count = (parseInt($("#halftoken_count").val()) || 0) - 1;
                                $("#halftoken_count").val(halftoken_count);
                                $(".halftoken_price").html("₦" + halftoken_price * halftoken_count);
                            }
                        });
                        $("#halftoken_plus").click(function() {
                            halftoken_count = (parseInt($("#halftoken_count").val()) || 0) + 1;
                            $("#halftoken_count").val(halftoken_count);
                            $(".halftoken_price").html("₦" + halftoken_price * halftoken_count);
                        });
                        $("#onetoken_min").click(function() {
                            if ($("#onetoken_count").val() > 0) {
                                onetoken_count = (parseInt($("#onetoken_count").val()) || 0) - 1;
                                $("#onetoken_count").val(onetoken_count);
                                $(".onetoken_price").html("₦" + onetoken_price * onetoken_count);
                            }
                        });
                        $("#onetoken_plus").click(function() {
                            onetoken_count = (parseInt($("#onetoken_count").val()) || 0) + 1;
                            $("#onetoken_count").val(onetoken_count);
                            $(".onetoken_price").html("₦" + onetoken_price * onetoken_count);
                        });
                    });

                    function buy_token(){
                    const API_publicKey = "{{$pay_info['API_publicKey']}}";
                    var amount=onetoken_price * onetoken_count+halftoken_count*halftoken_price;
                    if(amount<1){
                        swal({
                            position: 'top-center',
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Please enter token count!",
                            type: "success"
                        });
                        return false;
                    }
                    var currency="{{$pay_info['currency']}}";
                    var x = getpaidSetup({
                            PBFPubKey: API_publicKey,
                            customer_email: "{{Auth::user()->email}}",
                            amount: amount,
                            customer_phone: "",
                            currency: currency,
                            payment_options: "card,account",
                            txref: "{{Auth::user()->name}}_"+Date.now(),
                            meta: [{
                                metaname: "flightID",
                                metavalue: "AP1234"
                            }],
                            onclose: function() {},
                            callback: function(response) {
                                var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                                console.log("This is the response returned after a charge", response);
                                if (
                                    response.tx.chargeResponseCode == "00" ||
                                    response.tx.chargeResponseCode == "0"
                                ) {
                            //window.location = "{{route('buytokenconfirm')}}?txref="+txref+"&amount="+amount+"&currency="+currency
                            $.get("{{route('buytokenconfirm')}}?txref="+txref+"&amount="+amount+"&currency="+currency,function(data){
                                if(data=="success"){
                                    swal({
                                        position: 'top-center',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        title: "Your token Buy Success!",
                                        type: "success"
                                    });
                                }else{
                                    swal({
                                        position: 'top-center',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        "title": "Sorry have been error!",
                                        "type": "error"
                                    });
                                }
                            });
                                } else {
                                    // redirect to a failure page.
                                }

                                x.close(); // use this to close the modal immediately after payment.
                            }
                        });
                    }
                </script>
            </div>
        </div>

@endsection