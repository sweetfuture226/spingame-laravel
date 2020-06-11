@extends('layouts.appMain')
@section('page_title') Home @endsection
@section('page_style')
<style media="screen">
            .sound-icon-container {
                top: 80px;
                right: 20px;
            }

            @media (max-width: 767px) {
                .sound-icon-container {
                    top: 50px;
                    right: 30px;
                }
            }

            @media (max-width: 359px) {
                .sound-icon-container {
                    top: 50px;
                    right: 5px;
                }
            }
            body{
                height:auto;
            }
        </style>
    @endsection
    @section('content')
        <div class="main-container home-screen">
            <div class="container background-spin-img-container" style="position: relative;">
                <div class="row navbar-container">
                    <span class="username_nav"><img src="{{asset('html/images/lifestyle.png')}}" class="open_btn" alt="" /></span>
                    <span class="choosegame_nav">Choose your game</span>
                    <div class="hamburger-btn-container" id="sidebar_click_btn">
                        <img src="{{asset('html/images/hamburger_btn.png')}}" class="open_btn" alt="" />
                        <img src="{{asset('html/images/hamburger_close_btn.png')}}" class="close_btn" alt="" />
                    </div>
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
                <style>
                    .choosejack {
                        font-size: 14pt;
                        margin-top: 15px;
                        position: absolute;
                        width: 100%;
                        color: #fbaa18;
                        font-weight: bold;
                        text-align: center;
                        overflow: hidden;
                        top: 170px;
                        left: 0;
                        z-index: 11;
                    }

                    .token-patch {
                        position: absolute;
                        width: 29%;
                        height: 30%;
                        /*margin-right:-20px;*/
                        background: url({{asset('images/token_patch.png')}});
                        background-size: cover;
                        background-position: center;
                        right: -10%;
                        top: -10%;
                        text-align: center;
                        -webkit-transform: rotate(20deg);
                        -moz-transform: rotate(20deg);
                        -o-transform: rotate(20deg);
                        -ms-transform: rotate(20deg);
                        transform: rotate(20deg);
                        padding-top: 15px;
                        color: white;
                        font-size: 17pt;
                        font-weight: bold;
                    }

                    .cooming_soon_patch {
                        position: absolute;
                        width: 100%;
                        font-family: Impact, Charcoal, sans-serif;
                        top: 40%;
                        text-align: center;
                        -webkit-transform: rotate(-40deg);
                        -moz-transform: rotate(-40deg);
                        -o-transform: rotate(-40deg);
                        -ms-transform: rotate(-40deg);
                        transform: rotate(-40deg);
                        -webkit-text-fill-color: yellow;
                        /* Will override color (regardless of order) */
                        -webkit-text-stroke-width: 1px;
                        -webkit-text-stroke-color: black;
                        font-size: 25pt;
                        font-weight: bold;
                    }

                    @media (max-width: 767px) {
                        .choosejack {
                            font-size: 14pt;
                            margin-top: 15px;
                            position: absolute;
                            width: 100%;
                            color: #fbaa18;
                            text-align: center;
                            overflow: hidden;
                            top: 90px;
                            left: 0;
                            z-index: 11;
                        }
                        .how_to_play {
                            padding-right: 15px !important;
                            padding-left: 15px !important;
                        }
                    }

                    .how_to_play {
                        padding-right: 90px;
                        padding-left: 90px;
                    }

                    .total-list-container {
                        width: 100%;
                        margin-top: 95px;
                        overflow: auto;
                        -webkit-overflow-scrolling: auto;
                    }
                    @media (max-width: 360px) and (max-height: 640px) {
                        .top_lifestyle {
                            width: 100%;
                        }
                        .lifestyle_last {
                            width: 50%;
                        }
                        .how_to_play{    font-size: 20px!important;}
                        marquee {font-size: 1rem;}
                        /* .lifestyle_end{} */
                    }
                </style>
                <div class="row certain-container">
                    <div class="sound-icon-container">
                        <a href="#" onclick="bgm_on(true)" style="display: inline-block;cursor: pointer;">
                            <img src="{{asset('html/images/sound_icon.png')}}" alt="" />
                        </a>
                    </div>

                
                    <div class="total-list-container">
                        <div class="col-md-8 gamelist-container" style="overflow:hidden ;margin:0 auto">
                        @foreach ($prizes as $prize)
                            <div class="single_game_box"
                            @if($prize['remain_winners_cash'] >= 1 || $prize['remain_winners_n500']>=1 || $prize['remain_winners_mystery_prize'] >=1 || $prize['remain_winners_jackpot'] >= 1)
                            onclick="go_spinroom({{$prize['id']}},{{$prize['token_count']}})" style="cursor: pointer;"
                            @endif >
                                <div class="game-title-container">
                                    <p>{{$prize['prize_name']}}</p>
                                </div>
                                <div class="game-img-description-container" style="background: url('{{$prize['img_url']}}');background-size: cover;background-position: center;overflow:inherit">
                                    <div class="token-patch">
                                        <span class="token-patch-lable">{{$prize['token_count']}}</span>
                                    </div>
                                    @if($prize['remain_winners_cash']<1 && $prize['remain_winners_n500']<1 && $prize['remain_winners_mystery_prize']<1 && $prize['remain_winners_jackpot']<1)
                                    <span class="cooming_soon_patch">Coming soon</span>
                                    @endif
                                    <div class="description-container" style="color: white; font-size: 20PX ">
                                        {{$prize['description']}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="col-md-8 gamelist-container" style="overflow:hidden ;margin:0 auto">
                        @foreach ($addprizes as $key=>$addprize)
                            <div class="single_game_box countdown-box-{{$key}}">
                                <div class="game-title-container">
                                    <p>{{$addprizes[$key]['prize_name']}}</p>
                                </div>
                                <div class="game-img-description-container" style="background: url('{{$addprize['img_url']}}');background-size: cover;background-position: center;overflow:inherit">
                                    <div class="token-patch">
                                       <span class="cooming_soon_patch">Coming soon</span>
                                    </div>
                                    <div class="countdown">
                                        <div class="{{$key}}-flipTimer">
                                        <div class="days"></div>
                                        <div class="hours"></div>
                                        <div class="minutes"></div>
                                        <div class="seconds"></div>
                                    </div>


                                    <div class="description-container" style="color: white; font-size: 20PX ">
                                        {{$addprize['description']}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <div class="row lifestyle-row" style="margin-top: 30px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 how_to_play" style="background: #00499c;font-size: 25px; color: aliceblue;">
                                <div class="row">
                                    <div class="col-md-12">*Load your wallet with tokens</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">*Click the prize you with to play for</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">*Spin the wheel</div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row lifestyle-row" style="margin: 5px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" style="text-align: center;">
                                <img src="{{asset('html/images/good_luck.png')}}" class="open_btn lifestyle_end" alt="" />
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
                <script>
                  $(document).ready(function() {
                    @foreach ($addprizes as $key=>$addprize)
                        $('.<?php echo $key?>-flipTimer').flipTimer({ 

                        // count up or countdown
                        direction: 'down', 
                        // the target <a href="https://www.jqueryscript.net/time-clock/">date</a>
                        date: '{{$addprizes[$key]['start_time']}}',
                      
                        // callback works only with direction = "down"
                        callback: function() { 

                            $('.countdown-box-{{$key}}').attr('display', 'none');
                            window.location.replace("{{url('/game/lifstyle')}}");
                            
                         }

                        });
                    @endforeach
                    });
                   
                    var user_prize_spin_counts = {
                        "53": 2,
                        "51": 2,
                        "54": 3,
                        "78": 3,
                        "57": 1,
                        "85": 2,
                        "82": 0,
                        "76": 2,
                        "86": 0
                    };

                    function go_spinroom(prize_id, token_count_for_game) {
                        if (token_count_for_game > 76.5) {
                            if (user_prize_spin_counts[prize_id] > 0) {
                                location.href='{{route('wheel.spinroom')}}?prize='+prize_id;
                                return true;
                            }
                            swal({
                                position: "top-center",
                                showConfirmButton: false,
                                timer: 1500,
                                title: "You do not have enough token to play this game",
                                type: "error"
                            });
                            return false;
                        } else {
                            location.href='{{route('wheel.spinroom')}}?prize='+prize_id;
                        }
                    }
                </script>
            </div>
        </div>
@endsection
