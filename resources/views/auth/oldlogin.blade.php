<!--author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>2juzane - login</title>
<!-- metatags-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Magnificent login form a Flat Responsive Widget,Login form widgets, Sign up Web 	forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->

<link href="{{ asset('css/login_style.css') }}" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
	#error{
		color: red;
		font-size: 20px;
		margin-bottom: 10px;
	}
</style>

</head>
<body>
	<div class="w3ls-main">
		<div class="wthree-heading">
			<h1></h1>
		</div>
			<div class="wthree-container">
				<div class="wthree-form">
					<div class="agileits-2">
						<h6 id="error">
							@if ($errors->any())
								@foreach ($errors->all() as $error)
			                		{{ $error }}<br>
			            		@endforeach
			            	@endif
						</h6>
					</div>
					<form method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="w3-user">
							<span><i class="fa fa-user-o" aria-hidden="true"></i></span>
							{{-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> --}}
							<input type="email" name="email" placeholder="email" value="{{ old('email') }}" required>
						</div>
						<div class="clear"></div>
						<div class="w3-psw">
							<span><i class="fa fa-key" aria-hidden="true"></i></span>
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<div class="clear"></div>

						<div class="clear"></div>
						<div class="w3l">
							<span><a href="#"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</a></span><span><a href="{{ route('password.request') }}">forgot password ?</a></span>  
						</div>

						<div class="clear"></div>
						<div class="w3l-submit">
							<input type="submit" value="Login">
						</div><br><br>
						{{-- <div class="clear"></div> --}}
						<div class="w3l">
							<span><a href="{{ route('register') }}">Or Signup here</a></span>  
						</div>
					</form>
				</div>
			</div>
	</div>
		{{-- <div class="agileits-footer">
			<p>&copy; Magnificent login Form. All Rights Reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
		</div> --}}
</body>
</html>

					
					
					
