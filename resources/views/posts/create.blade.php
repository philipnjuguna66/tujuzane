@extends('layouts.app')

@section('title', 'New Post')
@section('content')

<style type="text/css">
    img{
      max-height: 150px;
    }
</style>

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

  <script type="text/javascript">

      $(document).ready(function(){
        $("#upload").click(function(){
            $(":file").trigger("click");
        });

        var srcChecker = setInterval(function(){
          if($("#blah").attr('src')){
            $("#blah").css('display', 'block');
            clearInterval(srcChecker);
          }
        }, 100);

    });

    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    function showAlert(value){
      if(value.length >= 10){
        $(".alert-info").fadeIn(2000);
      } 
    }
  </script>

<div class="container">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<form method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data">
	{{ csrf_field() }}

    <div class="panel panel-default">
      
      <p style="margin: 10px;">Speak out to the world</p>

      <div class="panel-footer">
        <input type="text" name="post_title" style="width:100%;font-size: 20px; padding: 10px;border:none;" placeholder="Heading" autofocus>
      </div>

      <div class="panel-body">
        <textarea name='post_body' onkeypress="showAlert(this.value)" cols="80" rows="5" style="width:100%;border:solid 1px lightgray; border-radius: 10px; margin:0; font-size: 16px; padding: 5px;" placeholder="Tell your story here..."></textarea>
      </div>

      <div class="panel-footer" style="padding: 10px;">

        <div class="alert alert-info" style=""> 
          You can upload a photo or image related to your post. Click on the browse button below. (JPEG or PNG only)
        </div>

        <input type="file" name="image" onchange="readURL(this)"  style="" />
        <img id="blah" style="display: none;" src="" class="img-responsive" height="100" width="200" alt="story image" />
      </div>

    </div>

    <div class="form-check">
        <button type="submit" class="btn btn-primary btn-14">Publish</button>
    </div>
</form>


</div>
</div>
</div>

@endsection