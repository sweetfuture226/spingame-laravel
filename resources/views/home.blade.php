@extends('layouts.app')
@section('page_title') Home @endsection
@section('page_css')
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
@endsection
@section('content')
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
    <div class="row certain-container" >
        <!--<img src="{{asset('images/left_certain.png')}}" class="left_blank_img" alt="">
        <img src="{{asset('images/right_certain.png')}}" class="right_blank_img" alt="">-->
        <div class="sound-icon-container">
            <a href="#" onclick="bgm_on(1)" style="display: inline-block;cursor: pointer;"><img src="{{asset('images/sound_icon.png')}}" alt=""></a>
        </div>
        <div class="home_container">
            <div class="logo-container">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>
            <div class="circle-img-container" style="">
                <img src="{{asset('images/spin_circle.png')}}" alt="">
            </div>
            <div class="text-container">
                <img src="{{asset('images/home_bottom_text.png')}}" alt="">
            </div>
        </div>
    </div>
<script>
$(document).ready(function(){
    $('.overlay').unbind("click");
    $( "#sidebar_click_btn").unbind( "click" );
    
});    
</script>
@endsection
