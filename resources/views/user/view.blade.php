
@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<style type="text/css">
    img.avatar {
      border: 1px solid #eee;
    }

    .only-bottom-margin {
      margin-top: 0px;
    }

    .activity-mini {
      padding-right: 15px;
      float: left;
    }
    .heads{
        font-weight: bold;
    }
</style>

<br>
<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 lead">
              <?php
               if(Auth::user()->name == $user->name){
                echo "Your";
               }else{
                echo "User";
               }
              ?>&nbsp;profile
              <hr></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-center">
                
                @if(!empty($user->user_photo) && Storage::exists('public'.$user->user_photo))
                
                  <img class="img-circle img-responsive avatar" style="-webkit-user-select:none;display:block; margin:auto;" src="{{ asset('storage'.$user->user_photo) }}">
                
                @else
                  <img class="img-circle img-responsive avatar" style="-webkit-user-select:none; 
                  display:block; margin:auto;" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg">
                @endif
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1 class="only-bottom-margin">{{ $user->name }}</h1>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">About me</h3>
                    </div>
                    <div class="panel-body">
                      @if($user->bio != "")
                        {{ $user->bio }}
                      @else
                        <em>nothing for now :-)</em>
                      @endif
                    </div>
                  </div>
                  <small class="text-muted">Joined&nbsp; {{ $user->created_at->toDayDateTimeString() }}</small>
                  
                </div>
                </div>
              </div>
            </div>
          </div>
          <?php

          if(Auth::user()->name == $user->name){
            ?>
            <div class="row">
              <div class="col-md-12">
                <hr><a href="{{ route('editme', ['user' => $user]) }}"><button class="btn btn-default pull-right"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div id="snackbar"></div>
</div>

<script src="{{ asset('js/myjs.js') }}"></script>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
<script type="text/javascript">
  $(document).ready(function(){

  });
</script>

@endsection('content')