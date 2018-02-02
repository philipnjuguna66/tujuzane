@extends('layouts.app')
@section('title', 'Login')

@section('content')

<link href="css/register.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/user.css">

<!-- Main -->
<div class="about-bottom main-agile book-form">
	<div class="alert-close"> </div>
	{{-- <h2 style="color: white; font-size: 18px;">Register</h2> --}}
	<form action="{{ route('login') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-date-w3-agileits">
			<label> Email </label>
			{{-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> --}}
			<input type="email" name="email" placeholder="Your Email" required value="{{ old('email') }}" autofocus id="emailfield">
			<label> Password </label>
			<input type="password" name="password" placeholder="Your Password" required>
			<br><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span style="color: white;">Remember me</span>
		</div>
		<div class="make wow shake">
			  <input type="submit" value="Login">
		</div>

		<br><span style="margin-top: 20px;"><a href="{{ route('password.request') }}" style="color: white;">Forgot password ?</a></span>
	</form>
</div>
<!-- //Main -->
</div>

<script src="js/myjs.js"></script>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
<script type="text/javascript">
  $(document).ready(function(){
  	$("#emailfield").focus();
  });
</script>
<!-- footer -->
{{-- <div class="footer-w3l">
	<p>&copy; 2017 Classy Register Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
</div> --}}
<!-- //footer -->

@endsection