@extends('layouts.authMaster')
@section('page_title') Register @endsection
@section('page_style')
    <style media="screen">
    .certain-container::before{
      background-image: none;
    }
        @media(max-width: 767px) {
            .register-container .input-container {
                width: 50%;
            }
            .register-container .auth-button {
                width: 50%;
                font-size: 17px;
            }
            .register-container .input-container input {
                font-size: 13px;
                padding-left: 5px;
            }
            .register-container .input-container label {
                font-size: 13px;
            }
        }

        @media only screen
        and (device-width : 375px)
        and (device-height : 812px)
        and (-webkit-device-pixel-ratio : 3) {
            .register-container .input-container {
                width: 60%;
            }
            .register-container .auth-button {
                width: 60%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row certain-container">
        <img src="./html/images/left_certain.png" class="left_blank_img" alt="">
        <img src="./html/images/right_certain.png" class="right_blank_img" alt="">
        <div class="sound-icon-container">
            <a href="#" style="display: inline-block;cursor: pointer;"><img src="./html/images/sound_icon.png" alt=""></a>
        </div>
        <div class="col-md-12 register-container background-spin-container">
            <div class="logo-img-container">
                <img src="./html/images/logo.png" alt="">
            </div>
            <form class="" action="{{route('register')}}" method="post" id="signup_form">
            {{ csrf_field() }}

                <div class="row signup_icon">
                    <div class="col-md-1"></div>
                    <div class="col-md-10" style="color: white;">
                        <div class="row signup_input">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label for="firstname">*First Name</label>
                                <input class="form-control" type="text" id="firstname" name="firstname" placeholder="FirstName" value="">
                            </div>
                            <div class="col-md-4"><label for="lastname">*Last Name</label>
                                <input class="form-control" type="lastname" id="lastname" name="lastname" placeholder="LastName" value="">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row signup_input">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label for="email">*Email</label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="">
                            </div>
                            <div class="col-md-4"><label for="telephone">*Telephone</label>
                                <input class="form-control" type="text" id="telephone" name="telephone" placeholder="Telephone" value="">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row signup_input">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label for="password">*Password</label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Password" value="">
                            </div>
                            <div class="col-md-4"><label for="confirmpassword">*Confirm Password</label>
                                <input class="form-control" type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" value="">
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div class="col-md-1"></div>

                </div>



                <div class="button-container">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="auth-button">SIGN UP</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <a href="{{ url('/auth/redirect/facebook') }}" class="auth-button facebook">
                        </a>
                            
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
@endsection
