@extends('layouts.app')
@section('page_title') Home @endsection
@section('page_css')
<style media="screen">
    @media only screen
    and (device-width : 375px)
    and (device-height : 812px)
    and (-webkit-device-pixel-ratio : 3) {
        .home_container > .circle-img-container {
            margin-top: 15px;
        }
    }
</style>
@endsection
@section('content')
<style>
    .certain-container::before{
        background-image:none
    }
</style>
<script>

var prize_spinremain_count={{$prize_info->spin_count}};
    $(document).ready(function () {

        $('#spiner').click(spinwheel);
        $('.spin-pin-image').click(spinwheel);
        spin = document.getElementById("spin-turnning-image");
    });
    function mailToWinner(){
      jQuery.ajax({
          url: '{{route('mailtowinner')}}',
          type:'post',
          data:{_token:$('meta[name=csrf-token]').attr("content")},
          success: function (data) {

          },
          async: true
      });
    }
    function showresult(prize) {
        switch (eval(prize)) {
            case 0:
                document.getElementById("audio_not_jackpot").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won FREE SPIN!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 1:
                document.getElementById("audio_xxx").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 2:
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won ₦{{$prize_info->cash_price}}!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                mailToWinner();
                document.getElementById("audio_not_jackpot").play();
                break;
            case 3:
                document.getElementById("audio_not_jackpot").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won FREE TOKEN!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 4:
                document.getElementById("audio_not_jackpot").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won ₦500 AIR TIME!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                mailToWinner();
                break;
            case 5:
                document.getElementById("audio_xxx").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 6:
                document.getElementById("audio_not_jackpot").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won FREE SPIN!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 7:
                document.getElementById("audio_not_jackpot").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won PRIZE {{$prize_info->mystery_prize}}!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                mailToWinner();
                break;
            case 8:
                document.getElementById("audio_xxx").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Click the wheel to spin again",
                    "type": "success"
                });
                break;
            case 9:
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won 1/2 TOKEN!<br>Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 10:
                document.getElementById("audio_xxx").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Click the wheel to spin again.",
                    "type": "success"
                });
                break;
            case 11:
                document.getElementById("audio_jackpot").play();
                swal({
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 4000,
                    "title": "Congratulations you won JACKPOT!",
                    "type": "success"
                });
                mailToWinner();
                break;
        }
        jQuery.ajax({
            url: '{{route('getspinremains')}}',
            data:{prize_id:{{$prize_id}}},
            success: function (data) {
                if(data<1){
                  setTimeout(function(){
                      swal({
                          position: 'top-center',
                          showConfirmButton: false,
                          timer: 3000,
                          "title": "Game Over",
                          "type": "warning"
                      });
                  },3500);
                  setTimeout(function(){
                      location.href='{{route('home')}}'
                  },5000);
                }
            },
            async: false
        });

    }
    var isspin = false;
    function spinwheel(event) {
        if (isspin) {
            spin_stop();
            isspin = false;
        } else {
            $("#spiner").css("display", "none");
            $("#spinboard").css("display", "block");

            animation_spin();
            isspin = true;
        }
    }

    var spin;

    var stopat;
    var stopatangle = 0;
    var i = 0;                     //  set your counter to 1
    //TODO remove nunecessary
    function animation_spin() {
        i = 0;
        $( ".spin-pin-image").unbind( "click" );
        $( "#spiner").unbind( "click" );
        jQuery.ajax({
            url: '{{route('getprizeindex')}}',
            data:{prize_id:{{$prize_id}}},
            success: function (data) {
                stopat = data;
            },
            async: false
        });
        if (stopat == 'token_limited') {
            swal({
                position: 'top-center',
                showConfirmButton: false,
                timer: 1500,
                "title": "You do not have enough tokens to play this game",
                "type": "error"
            });
            setTimeout(function(){
                location.href='{{route('home')}}'
            },3000);
            $( ".spin-pin-image").click(spinwheel);
            $( "#spiner").click(spinwheel);
            return;
        }else if (stopat == 'spin_limited') {
            swal({
                position: 'top-center',
                showConfirmButton: false,
                timer: 1500,
                "title": "You do not have enough token to play this game",
                "type": "error"
            });
            setTimeout(function(){
                location.href='{{route('home')}}'
            },3000);
            $( ".spin-pin-image").click(spinwheel);
            $( "#spiner").click(spinwheel);
            return;
        }
        //spin.style.transform = 'rotate(0deg)';
        stopatangle = (stopat) * 30 + 3260;
        setTimeout(function(){
            spin.style.webkitTransform = 'rotate('+stopatangle+'deg)';
            document.getElementById("audio_bgm").pause();
            document.getElementById("audio_wheel_spining").play();
        },400);
        setTimeout(function(){
            showresult(stopat);
            if(getCookie("bgm_on")==1){
              document.getElementById("audio_bgm").play();
            }

            $( ".spin-pin-image").click(spinwheel);
            $( "#spiner").click(spinwheel);

        },16500)
        //myLoop();
    }
    function spin_stop() {
        $("#spinboard").css("display", "none");
        $("#spiner").css("display", "");
        //document.getElementById("audio_bgm").play();
        spin.style.transform = 'rotate(0deg)';
    }
</script>
<style>
    .style-title-container{
        margin-top: -70px;
    }
    @media (max-width: 767px) {
        .style-title-container{
            margin-top: -30px;
        }
    }
    #spinboard {
        width: 30%;
        margin:0 auto;
        position: relative;
    }
    @media(max-width: 991px) {
        #spinboard {
            width: 60%;
            margin:0 auto;
            position: relative;
        }
    }
    @media(max-width: 767px) {
        #spinboard {
            width: 75%;
            margin:0 auto;
            position: relative;
        }
    }
    #spinboard > img.spin-bg-image {
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }

    #spinboard > img.spin-turnning-image {
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 2;
        -webkit-transition: -webkit-transform 15s ease-out;
        /*-webkit-animation: rotating 1s linear infinite;
        -moz-animation: rotating 1s linear infinite;
        -ms-animation: rotating 1s linear infinite;
        -o-animation: rotating 1s linear infinite;
        animation: rotating 1s linear infinite;*/
    }

    #spinboard > img.spin-pin-image {
        position: absolute;
        cursor:pointer;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 3;
    }
    .logo-container:first-child{
        margin-top: 140px;
        font-size: 18pt;
        color: #fff;
    }
    @media(max-width: 767px) {
        .logo-container:first-child{
            margin-top: 80px;
            font-size: 16pt;
            color: #fff;
        }
    }
    .spin_message{
        width:50%
    }
    @media(max-width: 767px) {
        .spin_message{
            width:70%
        }
    }

</style>
<audio id="audio_jackpot">
    <source src="/music/jackpot.mpeg">
    <source src="/music/jackpot.mp3">
</audio>
<audio id="audio_not_jackpot">
    <source src="/music/not_jackpot.mpeg">
    <source src="/music/not_jackpot.mp3">
</audio>
<audio id="audio_wheel_spining">
    <source src="/music/wheel_spining.mpeg">
    <source src="/music/wheel_spining.mp3">
</audio>
<audio id="audio_xxx">
    <source src="/music/xxx.mpeg">
    <source src="/music/xxx.mp3">
</audio>
<div class="row certain-container" >
    <!--<img src="{{asset('images/left_certain.png')}}" class="left_blank_img" alt="">
    <img src="{{asset('images/right_certain.png')}}" class="right_blank_img" alt="">-->
    <div class="sound-icon-container">
        <a href="#" onclick="bgm_on(1)" style="display: inline-block;cursor: pointer;"><img src="{{asset('images/sound_icon.png')}}" alt=""></a>
    </div>
    <!--<div class="col-md-12 style-title-container">
        <img src="/images/jackpotprize.png" alt="">
    </div>-->

    <div class="home_container">
        <div class="logo-container" style="margin-top: 0px">
            <img src="/images/logo.png"  alt="">
            <div ><img class="spin_message"  src="/images/spin_message.png" alt=""></div>
            <!--<p>SPINS LEFT TODAY:
                <span style="font-weight: bold;">
                    <?php
                    if(isset($prize_info->spin_count)){
                        echo $prize_info->spin_count;
                    }else{
                        echo config('constants.default_spin_count');
                    }
                    ?> MAX
                </span>
            </p>
            <p>TIMER FOR GAME: <span style="font-weight: bold;">00:00</span> (24 HOURS)</p>
            -->
        </div>
        <div class="circle-img-container" >
            <img id="spiner" src="{{asset('images/spin_circle.png')}}" style="cursor:pointer">
            <div id="spinboard" class="spin-container" style="display:none">
                <img src="/images/turn_bg_spin_room.png" class="spin-bg-image" alt="">
                <img src="/images/turning_spin.png" id="spin-turnning-image" class="spin-turnning-image"  alt="">
                <img src="/images/spin_pin.png" class="spin-pin-image"  alt="">
            </div>
        </div>
        <div class="text-container">
            <img src="{{asset('images/home_bottom_text.png')}}" alt="">
        </div>
    </div>
</div>
@endsection
