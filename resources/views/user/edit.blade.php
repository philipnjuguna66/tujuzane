@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/user.css') }}">
<style type="text/css">
  h6:hover{
    color:green;
  }
  @media only screen and (max-width: 600px) {
    #profileImage{
      width: 200px;
      height:200px;
    }
  }
</style>

<div class="container" style="background: white">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
		<form id="userEditForm" class="form-horizontal" role="form" method="POST" action="{{ route('update.me') }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          
        	@if(!empty($user->user_photo))
          
            <img id="profileImage" class="img-circle img-responsive avatar" style="-webkit-user-select:none;display:block; margin:auto;" src="{{ $user->user_photo }}">
          
          @else
            <img id="profileImage" class="img-circle img-responsive avatar" style="-webkit-user-select:none; 
            display:block; margin:auto;" src="https://www.shareicon.net/data/128x128/2016/06/25/786529_people_512x512.png">
          @endif

          <h6 onclick="doTheFollowing(this)" style="cursor:pointer;">Upload a different photo?</h6>
          
          <input type="hidden" role="uploadcare-uploader" name="image" data-crop="">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-7 personal-info">
        <h3>Personal info</h3>
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          Your current name and email are shown in the boxes. If you don't intend to change them, leave the boxes blank.
        </div>
        
        <div class="">

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
              @if(isset($user->bio))
                {{ $user->bio }}
              @endif
            </textarea>
            </div>
          </div>

          <div class="">
            <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                 <a href="#" data-toggle="modal" data-target="#pwdModal" id="changepasstext">Change your password</a>
                 <a href="#" style="display: none;" id="cancelPassChanging" onclick="cancelPassChanging(this);">Cancel Changing password</a> 
                </div>
             </div>
          <div id="passEditing" style="display: none;"> 
            <div class="form-group">
              <label class="col-md-3 control-label">New Password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="password" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Confirm password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="password_confirmation" placeholder="confirm password">
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
		          <h5 class="text-center" id="modalHeader">Please enter your current password to confirm this is you.</h5>
		      </div>
		      <div class="modal-body">
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

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
<script type="text/javascript">
  /* variables  */
  var confirmPassRoute = "{{ route('confirm.pass') }}";
  var token = "{{ Session::token() }}";

  function cancelPassChanging(element){
    $("#passEditing").css('display', 'none');
    $("#changepasstext").css('display', 'block');
    $(element).css('display', 'none');
  }

</script>
<script type="text/javascript" src="js/myjs.js">
</script>

@endsection('content')