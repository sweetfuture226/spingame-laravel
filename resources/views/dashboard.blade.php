@extends('layouts.appMain')
@section('page_title') Home @endsection
@section('page_style')

 
<!-- <script src="{{asset('html/js/sidebar.js')}}" charset="utf-8"></script> -->
<style media="screen">
        .total-list-container {
            margin-top: 125px;
            margin-bottom: 50px;
            -webkit-overflow-scrolling: touch;
        }
        
        @media (max-width: 767px) {
            .total-list-container {
                margin-top: 120px;
                -webkit-overflow-scrolling: touch;
            }
        }
        body{height: unset;}
        .text-container {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 20px;
            /* position: absolute; */
            width: 100%;
            left: 0;
            bottom: 20px;
        }
        
        .sound-icon-container {
            top: 80px;
            right: 20px;
        }
        
        @media (max-width: 767px) {
            .sound-icon-container {
                top: 60px;
                right: 20px;
            }
        }
        
        @media (max-width: 359px) {
            .sound-icon-container {
                top: 50px;
                right: 5px;
            }
        }
        @media (min-width: 992px) {
            .sound_icon_da{
                width: 65%;
            }
        }
        
        .style-title-container {
            margin-top: -60px;
        }
        
        @media (max-width: 767px) {
            .style-title-container {
                margin-top: -30px;
            }
        }
        @media (min-width: 768px) {
            .sound-icon-container {
                top: 60px;
                right: 20px;
            }
        }
       
        .subtitle {
            font-size: 20pt;
            margin-top: 15px;
            margin-left: auto;
            margin-right: auto;
            /*position: absolute;
        top: 190px;*/
            width: 100%;
            color: #fff;
            text-align: center;
            overflow: hidden;
            left: 0;
        }
        
        @media (max-width: 767px) {
            .subtitle {
                /*top: 130px;*/
                left: 0;
            }
        }
        
        .prize-info-container {
            font-size: 18pt;
            color: #fff;
        }
        
        .prize-title {
            text-transform: capitalize;
            font-size: 20pt;
            text-decoration: underline;
        }
        
        .prize-remain-spins {
            width: 80%;
            margin-left: 5%;
            font-size: 16pt;
            color: #fff;
        }
        
        .prize-wons {
            width: 80%;
            margin-left: 5%;
            font-size: 16pt;
            text-transform: capitalize;
            color: #fff;
        }
        
        .username_nav {
            text-align: center;
        }
        
        .username_nav>img {
            width: 65%;
        }
        
        @media (max-width:767px) {
            table {
                width: 85%;
                margin: auto;
            }
            th,
            td {
                padding: 8px;
            }
        }
        
        @media (max-width:360px) and (max-height:640px) {
            .total-list-container {
                margin-top: 70px!important;
            }
            .token_av {
                margin-top: -4px!important;
                width: 70%;
            }
            .prize-title {
                text-transform: capitalize;
                font-size: 10pt!important;
                text-decoration: underline;
            }
            .prize-remain-spins {
                width: 80%;
                margin-left: 5%;
                font-size: 10pt!important;
                color: #fff;
            }
            .prize-wons {
                width: 80%;
                margin-left: 5%;
                font-size: 10pt!important;
                text-transform: capitalize;
                color: #fff;
            }
            .desc {
                font-size: 10pt!important;
            }
            .w3-container>img {
                width: 30%;
            }
            th,
            td {
                padding: 8px;
                text-align: center;
                color: #feee8d;
                border-bottom: 1px solid #0051ad;
            }
            table {
                width: 90%;
                margin: auto;
            }.sound-icon-container {
                top: -3px;
                z-index: 3344;
                right: 20px;
            }
        }
    </style>
@endsection
@section('content')

<div class="main-container home-screen">
        <div class="container background-spin-img-container" style="position: relative;">
            <div class="row navbar-container">
                <span class="username_nav"><img src="{{asset('html/images/darshboard.png')}}" class="open_btn" alt="" /></span>
                <span class="choosegame_nav">Choose your game</span>
                <div class="hamburger-btn-container" id="sidebar_click_btn">
                    <img src="{{asset('html/images/hamburger_btn.png')}}" class="open_btn" alt=""/>
                    <img src="{{asset('html/images/hamburger_close_btn.png')}}" class="close_btn" alt=""/>
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
                            <li> <a href="{{route('invite')}}">Invite Friends</a> </li>
                            <li> <a href="{{route('contact')}}">Contact Us</a> </li>
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                </div>
            </div>

            <div class="row certain-container-darshboard">
                <div class="sound-icon-container">
                    <a href="#" onclick="bgm_on(true)" style="display: inline-block;cursor: pointer;">
                        <img src="{{asset('html/images/sound_icon.png')}}" class="sound_icon_da" alt="" />
                    </a>
                </div>

                <div class="total-list-container" style="background-color: #00499c;">
                    @foreach(Auth::user()->unreadNotifications as $notification)
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Congratulations!</strong> You received {{$notification->data['thread']}} from admin.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="markNotificationAsRead()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                    <div class="col-md-12 ">
                        <div class="subtitle">
                            <img src="{{asset('html/images/for_darshboard.png')}}" class="open_btn token_av" style="margin-top: -12px;" alt="" /> &nbsp;&nbsp;
                            <span style="font-weight: bold;">{{$token_count}}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($prizes as $prize)

                            <div class="col-md-3" style="justify-content: center;display: flex;">
                                <div class="single_game_box" onclick="go_spinroom(86,1)" style="cursor: pointer;">
                                    <div class="game-title-container">
                                        <p>Active Games</p>
                                    </div>
                                    <div class="game-img-description-container" style="background: url({{asset('images/buytoken_bg_1px.png')}});background-size: cover;background-position: center;overflow:inherit">
                                        <div class="prize-title">{{$prize['prize_name']}}</div>
                                        <div class="prize-remain-spins">Remaining Spins:{{$prize['spin_count']}}</div>    
                                    </div>
                                </div>
                            </div>

                            @endforeach
                           
                          

                        </div>
                    </div>
                </div>


                

                <div class="table-container" style="width: 100%;">
                    <div class="w3-container" style="text-align: center;">
                        <caption>
                            <img src="{{asset('html/images/for_darshboard_table.png')}}" style="    margin-bottom: 5px;
                            border-bottom: 2px solid #fff;" alt="" />
                        </caption>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <table class="w3-table-all w3-hoverable">
                                    <thead>
                                        <tr class="w3-light-grey">
                                            <th>Date</th>
                                            <th>Prize</th>
                                            <th>Received</th>
                                            <th>.....</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $spin_indexs = config('constants.spin_indexs');
                                    ?>
                                    <tboard>
                                        @foreach ($prizes as $prize)
                                            @foreach($prize['prize_wons'] as $prize_won)
                                                <tr>
                                                <td>{{$prize_won->created_at}}</td>
                                                <td>
                                                    @if($prize_won->spin_index==11)
                                                    {{$prize['prize_name']}}
                                                    @elseif($prize_won->spin_index==7)
                                                    {{$prize['mystery_prize']}}
                                                    @else
                                                    {{$spin_indexs[$prize_won->spin_index][0]}}
                                                    @endif
                                                </td>
                                                <td>{{$prize['prize_cost']}}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tboard>
                                </table>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="text-container">
                            <img src="{{asset('html/images/home_bottom_text.png')}}" alt="" />
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>
    <script>
         function markNotificationAsRead(){
            $.get('/markAsRead');

            // doument.location(url('markAsRead'));
            // alert('clicked');
            // window.location.replace("{{Route('markAsRead')}}");
        }
    </script>
@endsection
