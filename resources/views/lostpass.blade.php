@extends('layouts.authMaster')
@section('page_title') Login @endsection
@section('content')
    <div class="row certain-container">
        <img src="{{asset('images/left_certain.png')}}" class="left_blank_img" alt="">
        <img src="{{asset('images/right_certain.png')}}" class="right_blank_img" alt="">
        <div class="sound-icon-container" >
            <a href="#" onclick="bgm_on(0)" style="display: inline-block;cursor: pointer;"><img src="{{asset('images/sound_icon.png')}}" alt=""></a>
        </div>
        <div class="col-md-12 login-container background-spin-container">
            <div class="logo-img-container">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>
            <form class="" action="{{route('lostpass')}}" method="post" id="lostpass_form">
                {{ csrf_field() }}
                <div class="input-container">
                    <div class="form-group">
                        <label for="email">*Email</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="">
                    </div>
                </div>
                <div class="button-container">
                    <button type="submit" class="auth-button" >Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
