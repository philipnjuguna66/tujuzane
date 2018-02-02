@extends('layouts.app')
@section('title', 'Register')

@section('content')

<link href="css/register.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/user.css">

<!-- Main -->
<div class="about-bottom main-agile book-form">
	<div class="alert-close"> </div>
	<h2 style="color: white; font-size: 18px;">Register</h2>
	<form action="{{ route('register') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-date-w3-agileits">
			<label> Name </label>
			<input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" required autofocus>
			<label> Email </label>
			{{-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> --}}
			<input type="email" name="email" placeholder="Your Email" required value="{{ old('email') }}">
			<label> Password </label>
			<input type="password" name="password" placeholder="Your Password" required>
			<label> CONFIRM Password </label>
			<input type="password" name="password_confirmation" placeholder="Confirm Password" required>
		</div>
		<div class="make wow shake">
			  <input type="submit" value="Register">
		</div>
	</form>
</div>
<!-- //Main -->
</div>
<!-- footer -->
{{-- <div class="footer-w3l">
	<p>&copy; 2017 Classy Register Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
</div> --}}
<!-- //footer -->

@endsection