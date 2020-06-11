<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Contact Us | Spin Game</title>
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
        <style>
        	.input-container input {
			    border: 2px solid #fff;
        	}
			.form-group {
			    margin-bottom: 1rem;
			}
			.input-container textarea {
			    width: 350px;
			    max-width: 100%;
			    background: transparent;
			    border-radius: unset;
			    border: 2px solid #fff;
			    color: #fff;
			    font-size: 17px;
			    padding-top: 10px;
			    padding-bottom: 10px;
			}

			.input-container textarea:hover {
			    background: transparent;
			    outline: none;
			    color: #fff;
			}
			.input-container textarea:focus {
			    border-color: #fff;
			    outline: none;
			    box-shadow: unset;
			    background: transparent;
			    color: #fff;
			}
			.input-container textarea::placeholder {
			    color: #dfdfdf;
			}
			.login-container {
				z-index: 1;
			}
			.social-icon {
			    margin-top: 20px;
			    position: absolute;
				bottom: 20px;
				left: auto;
				right: auto;
				left: 0;
				right: 0;
			}
			.social-icon div {
			    text-align: center;
			}
			.social-icon img {
			    width: 100%;
			}

			@media screen and (max-width: 770px) {
				.login-container {
				    padding-top: 20px;
				}
				.social-icon {
					position: relative;
				}
				.login-container > form {
				    margin-top: 0px;
				}
				.social-icon img {
				    width: auto;
				    height: 110px;
				}
				.button-container {
				    padding-top: 0px;
				    padding-bottom: 20px;
				}
			}
		</style>
    </head>
    <body>
        <audio id="audio_bgm" loop>
            <source src="{{asset('music/bgm.mpeg')}}">
        </audio>
        <div class="main-container home-screen">
            <div class="container background-spin-img-container" style="position: relative;">
                <div class="row navbar-container">
                    <span class="username_nav">Contact Us</span>
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
                

				<div class="container">
				    <div class="row certain-container">
				    	<!-- 
				        <img src="{{asset('images/left_certain.png')}}" class="left_blank_img" alt="">
				        <img src="{{asset('images/right_certain.png')}}" class="right_blank_img" alt=""> -->
				        <div class="sound-icon-container" >
				            <a href="#" onclick="bgm_on(0)" style="display: inline-block;cursor: pointer;"><img src="{{asset('images/sound_icon.png')}}" alt=""></a>
						        </div>
						<h1>Contact US Form</h1>


				        <div class="col-md-12 login-container background-spin-container">


							@if(Session::has('success'))
							   <div class="alert alert-success">
							     {{ Session::get('success') }}
							   </div>
							@endif
							@if(Session::has('error'))
							   <div class="alert alert-danger">
							     {{ Session::get('error') }}
							   </div>
							@endif
							<form method="post" action="/contact-us">

							<!-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Name:</label>
							<input type='name' name='name' class='form-control' placeholder='Enter Name' />
							<span class="text-danger">{{ $errors->first('name') }}</span>
							</div> -->

							<div class="input-container form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label>Email:</label>
							<input name='email' type='email' class='form-control' placeholder='Enter Email' />
							<span class="text-danger">{{ $errors->first('email') }}</span>
							</div>

							<div class="input-container form-group {{ $errors->has('message') ? 'has-error' : '' }}">
							<label>Message:</label>
							<textarea name='message' class='form-control' placeholder="Enter Message"></textarea>
							<span class="text-danger">{{ $errors->first('message') }}</span>
							</div>

							<div class="button-container">
							<button class="auth-button">Contact US!</button>
							</div>
							{{csrf_field()}}
							</form>
							
							<div class="row social-icon">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<a href="https://www.instagram.com/playthriftgift/">
										<img src="{{asset('images/instagram.png')}}" alt="">
									</a>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<a href="https://www.twitter.com/playthriftgift/">
										<img src="{{asset('images/twitter.png')}}" alt="">
									</a>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<a href="https://www.facebook.com/playthriftgift/">
										<img src="{{asset('images/fb.png')}}" alt="">
									</a>
								</div>
							</div>
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