@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">

<div class="container" style="background: white">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('update.me') }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          
        	@if(!empty($user->user_photo) && Storage::exists('public'.$user->user_photo))
          
            <img class="img-circle img-responsive avatar" style="-webkit-user-select:none;display:block; margin:auto;" src="{{ asset('storage'.$user->user_photo) }}">
          
          @else
            <img class="img-circle img-responsive avatar" style="-webkit-user-select:none; 
            display:block; margin:auto;" src="https://www.shareicon.net/data/128x128/2016/06/25/786529_people_512x512.png">
          @endif

          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control" name="image">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-7 personal-info">
        <h3>Personal info</h3>
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          Your current name and email are shown in the boxes. If you don't intend to change them, leave the boxes blank.
        </div>
        
        <div class="col-lg-9">

          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="name" placeholder="{{ $user->name }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="email" name="email" placeholder="{{ $user->email }}">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">About me:</label>
            <div class="col-lg-8">
              <textarea name="bio" class="form-control" id="bio" rows="3" placeholder="About me. E.g 'Passionate real estate manager'">
              @if(old('bio') != null)
                {{ old('bio') }}
              @elseif(isset($user->bio))
                {{ $user->bio }}
              @endif
            </textarea>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                 <a href="#" data-toggle="modal" data-target="#pwdModal" id="changepasstext" onclick="dothis();">Change your password</a>
                </div>
             </div>
          <div id="passEditing" style="display: none;"> 
            <div class="form-group">
              <label class="col-md-3 control-label">New Password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="password" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Confirm password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="password_confirmation" value="">
              </div>
            </div>
          </div>
          </div>
        </div>

          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8 col-md-offset-4">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" onclick="" value="Cancel">
            </div>
          </div>
          <div id="snackbar"></div>
        </form>

        <!--modal-->
		<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog">
		  <div class="modal-content">
		      <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h5 class="text-center">Please enter your current password to confirm this is you.</h5>
		      </div>
		      <div class="modal-body">
		      	{{-- <form method="POST" action="{{ url('/confirmpassfirst') }}">
		      		{{  csrf_field() }}
		          </form> --}}
              <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-body">
                          <div class="text-center">
                              <div class="panel-body">
                                  <div class="form-group">
                                    <input type="hidden" value="{{ $user->email }}">
                                    <input class="form-control" placeholder="Password" type="password" id="passwordFirst">
                                  </div>
                                  <input class="btn btn-primary btn-block" onclick="confirmPassword(this)" value="Confirm" data-dismiss="modal">
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
		      </div>
		      <div class="modal-footer">
		          <div class="col-md-12">
		          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				  </div>	
		      </div>
		  </div>
		  </div>
		</div>
  </div>
</div>
<hr>

<script type="text/javascript">
  /* variables  */
  var confirmPassRoute = "{{ route('confirm.pass') }}";
  var token = "{{ Session::token() }}";
</script>
<script type="text/javascript" src="{{ asset('js/myjs.js') }}">
</script>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

@endsection('content')