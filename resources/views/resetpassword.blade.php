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
            <form class="" action="{{route('passwordreset')}}" method="post" id="lostpass_form">
                <input type="hidden" name="nonce" value="{{$nonce}}">
                {{ csrf_field() }}
                <div class="input-container">
                    <div class="form-group">
                        <label for="newpassword">*New Password</label>
                        <input class="form-control" type="password" id="newpassword" name="newpassword"  value="">
                    </div>
                </div>
                
                <div class="input-container">
                    <div class="form-group">
                        <label for="passowrd_confirm">*Password Confirm</label>
                        <input class="form-control" type="password" id="passowrd_confirm" name="passowrd_confirm"  value="">
                    </div>
                </div>
                <div class="button-container">
                    <button type="submit" class="auth-button" >Reset Password</button>
                </div>
            </form>
        </div>
    </div>
<script>
    $('#lostpass_form').on('submit', function(e) {
        if($('#newpassword').val()==$('#passowrd_confirm').val()){
            $('#lostpass_form').submit();
        }else{
            swal({
                position: 'top-center',
                showConfirmButton: false,
                timer: 3000,
                "title": 'Password and confirm password does not match!',
                "type": "error"
            });
            return false;
        }
    });
</script>
@endsection
