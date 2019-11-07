<?php
    if (empty(session()->get('user_id')))
    {
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V11</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta name="csrf-token" content="{{ csrf_token() }}">

<!--===============================================================================================-->	
	{{-- Google Auth Integration --}}
	{{-- <meta name="google-signin-client_id" content="444270873683-153farkm16lmmb523svkdv7tf3399se4.apps.googleusercontent.com"> --}}
	
	{{-- <script src="https://apis.google.com/js/platform.js" async defer></script> --}}
	{{-- <script src="{{ asset ('assets/google/platform.js') }}" async defer></script> <!-- Google API --> --}}
	{{-- <script src="{{ asset ('assets/google/external.js') }}" async defer></script> <!-- Custom script --> --}}
	{{-- google jquery --}}

	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/registration/style/style.css') }}">
<!--===============================================================================================-->	

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset ('assets/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/main.css') }}">
<!--===============================================================================================-->
<script src="{{ asset ('assets/registration/registration.js') }}" async defer></script> <!-- Custom CSS -->

</head>

<style>
	button.btn-google.m-b-10.g-signin2 .abcRioButton.abcRioButtonLightBlue {
    width: 100% !important;
}
	.valid {
		color: green;
	}
	.invalid {
		color: red;
	}
	.signup{
		display: show;
	}
	.signin{
		display: none;
	}
	
	

</style>
	
<body>

	<div class="limiter">
		<div class="container-login100">
			{{-- --------------------------------------------------------------------- --}}
			{{-- Signup Form --}}
			{{-- --------------------------------------------------------------------- --}}
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30 signup">

				{{-- junaid code --}}
				<div class="">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>

				{{-- end junaid code --}}

				
				<form class="login100-form validate-form ">
					<span class="login100-form-title p-b-25">
						Sign up
					</span>

					{{-- Display Error --}}
					<span id="success" class="text-success"></span>
					<div class="wrap-input100 validate-input m-b-16" >
						<span id="success" class="text-success"></span>
						{{-- <span id="error" class="text-danger"></span>						
						<span id="error_empty" class="text-danger"></span>
						<span id="error_name" class="text-danger"></span> --}}
					</div>
					{{-- <div class="alert alert-success wrap-input100 validate-input m-b-16" id="success" role="alert">
					</div> --}}
					<div class="alert alert-danger wrap-input100 validate-input m-b-16" id="error" role="alert">
					</div>
					<div class="alert alert-danger wrap-input100 validate-input m-b-16" id="error_empty" role="alert">
					</div>
					<div class="alert alert-danger wrap-input100 validate-input m-b-16" id="error_name" role="alert">
					</div>
					{{-- end error code --}}

					<div class="wrap-input50 validate-input m-b-16" data-validate = "First name required">
						<input class="input100" type="text" id="fname" name="fname" placeholder="First Name">
					</div>

					<div class="wrap-input50 validate-input m-b-16" data-validate = "Last name required">
						<input class="input100" type="text" id="lname" name="lname" placeholder="Last Name">
					</div>
					
					{{-- junaid code --}}
					{{-- <span id="error_username" class="text-danger"></span> --}}
					{{-- end junaid code --}}
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username required">
						<input class="input100" type="text" id="username" name="username" placeholder="Username">
					</div>
					{{-- Display Error --}}
					<div class="alert alert-danger wrap-input100 validate-input m-b-16" id="error_username" role="alert">
					</div>

					{{-- junaid code --}}
					{{-- <span id="error_email" class="text-danger"></span> --}}
					{{-- end junaid code --}}
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" id="email" name="email" placeholder="Email">
					</div>
					{{-- Display Error --}}
					<div class="alert alert-danger wrap-input100 validate-input m-b-16" id="error_email" role="alert">
					</div>




					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" id="password" name="password" placeholder="Password">
					</div>
					{{-- Error code --}}
					<div class="alert alert-danger wrap-input100 validate-input m-b-16" id="error_pwd" role="alert">
						<p id="error_password" class="text-danger"></p>
						<p id="error_letter" class="text-danger"></p>
						<p id="error_capital" class="text-danger"></p>
						<p id="error_number" class="text-danger"></p>
						<p id="error_length" class="text-danger"></p>
					</div>

					{{-- <div> --}}
						{{-- <p id="error_password" class="text-danger"></p> --}}
						{{-- <p id="error_letter" class="text-danger"></p>
						<p id="error_capital" class="text-danger"></p>
						<p id="error_number" class="text-danger"></p>
						<p id="error_length" class="text-danger"></p> --}}
					{{-- </div> --}}
					{{-- end error code --}}

					{{-- junaid code --}}
					<div id="message" style="display:none;">
						<strong>Password must contain the following:</strong>
						<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
						<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
						<p id="number" class="invalid">A <b>number</b></p>
						<p id="length" class="invalid">Minimum <b>8 characters</b></p>
					</div>
					{{-- end junaid code --}}

					<div class="contact100-form-checkbox m-l-4 signup_text">
						By signing up, you agree to our <a href="#">Terms</a> , <a href="#">Data Policy</a> and <a href="#">Cookies Policy</a>.
					</div>
					
					<div class="container-login100-form-btn p-t-15">
						<button class="login100-form-btn" id="signupBtn" name="signupBtn">
							Signup
						</button>
					</div>

					<div class="text-center w-full p-t-28 p-b-18">
						<span class="txt1">
							Or signup with
						</span>
					</div>


					<a href="{{ url ('login/facebook') }}" class="btn-face m-b-10">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>
					{{-- end facebook integration --}}

					<a href="{{ url ('login/google') }}" class="btn-google m-b-10">
						<img src="{{ asset('assets/images/icons/icon-google.png') }}" alt="GOOGLE">
							Google
					</a>
					{{-- end gmail login code --}}


					<button type="button" class="btn-notamember m-b-10" id="sign_in_now" class="sign_in_now" >
						Already have an account? Login!
					</button>

				</form>
			</div>
			{{-- --------------------------------------------------------------------- --}}
			{{-- end Signup Form --}}
			{{-- --------------------------------------------------------------------- --}}

			{{-- --------------------------------------------------------------------- --}}
			{{-- login form --}}
			{{-- --------------------------------------------------------------------- --}}
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30 signin">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-25">
						LOGO
					</span>

					{{-- junaid code --}}
					<p id="error_creditional" class="text-danger"></p>
					<p id="login_success" class="text-success"></p>
					{{-- end junaid code --}}
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="user" name="user" placeholder="Email">
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" id="pass" name="pass" placeholder="Password">
					</div>

					<div class="contact100-form-checkbox m-l-4 forgot_pass">
						<a href="{{ url ('confirm-email-address') }}">Forgot Password?</a>
					</div>
					
					<div class="container-login100-form-btn p-t-15">
						<button class="login100-form-btn signin" id="login" name="login" >
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-28 p-b-18 ">
						<span class="txt1">
							Or login with
						</span>
					</div>

				
					<a href="{{ url ('login/facebook') }}" class="btn-face m-b-10 ">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>
				
					<a href="{{ url ('login/google') }}" class="btn-google m-b-10 ">
						<img src="{{ asset ('assets/images/icons/icon-google.png') }}" alt="GOOGLE">
						Google
					</a>
					{{-- end integration --}}

					<button type="button" class="btn-notamember m-b-10 signin" id="sign_up_now" name="sign_up_now">
						Not a member? Sign up now!
					</button>
				</form>
			</div>
			{{-- -------------------------------------------------------------------------- --}}
			{{-- end form --}}
			{{-- -------------------------------------------------------------------------- --}}
		</div>
	</div>


	
<!--===============================================================================================-->	
	<script src="{{ asset ('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset ('assets/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset ('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset ('assets/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset ('assets/js/main.js') }}"></script>


</body>
</html>


<?php 
    }
    else
    {
		// Go to welcome page
        // dd("NO");
        // echo "Empty";
        //  return redirect('/signin');
        // Redirect::route('signin');
        // redirect()->route('signin');
        // Redirect::to('/signin');
        header("Location: http://127.0.0.1:8000");exit;

    }
?>