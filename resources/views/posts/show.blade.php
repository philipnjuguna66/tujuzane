@extends('layouts.app')

@section('title', 'View Post')
@section('content')

<link href="{{ secure_asset('post/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
{{-- <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/app.css') }}"> --}}
<link href="{{ secure_asset('css/user.css') }}" rel="stylesheet">

<style type="text/css" media="screen">
	
</style>

<div class="container">

		<div class="col-md-8 col-md-offset-2 btm-wthree-left" style="background: white; padding-left: 15px;">
			<div class="single-left">
				<div class="single-left1">
					<br>
					{{--  @if(!empty($post->post_photo) && Storage::exists('public'.$post->post_photo))
						<img src="{{ asset('storage'.$post->post_photo) }}" style="max-height: 300px; width: 100%; border-radius: 5px;" class="img-responsive" />
					@endif  --}}
					@if(!empty($post->post_photo))
					<img src="{{ $post->post_photo }}" style="max-height: 300px; width: 100%; border-radius: 5px;" class="img-responsive" />
					@endif
					<h3>{{ $post->post_title }}</h3>
					<ul>  
						@if(Auth::user() != $post->user)
							<li><i class="fa fa-user"></i><a href="{{ route('view', ['user' => $post->user]) }}">&nbsp;&nbsp;{{ $post->user->name }}</a></li>
						@endif
						<li><i class="fa fa-calendar"></i>  {{ $post->created_at->diffForHumans() }}</li>
						@if(Auth::user() == $post->user)
							<li><a href="{{ route('post.edit', ['post' => $post]) }}"><i class="fa fa-edit">&nbsp;Edit</i></a></li>
							<li><i class="fa fa-trash" onclick="confirmDelete(this)" style="cursor: pointer;">&nbsp;Delete</i><a href="{{ route('post.delete', ['post' => $post]) }}" id="delete"></a></li>
						@endif
					</ul>
					<p>{{ $post->post_body }}</p>
				</div>
			<div class="single-left2">
			
				<div class="comments">
					<hr>
					<a name="comments"></a>
					<h3>Comments</h3>
					<div class="comments-grids">
						@if(count($post->comments) > 0)
							@foreach($post->comments as $comment)
								<div class="comments-grid">
									<div class="comments-grid-left">
										@if(!empty($comment->user->user_photo))
											<a href="{{ route('view', ['user' => $comment->user]) }}"><img src="{{ $comment->user->user_photo }}" alt=" " class="img-responsive" style="max-height: 100px; max-width: 80px;" /></a>
										@else
											<a href="{{ route('view', ['user' => $comment->user]) }}"><img src="https://www.shareicon.net/data/128x128/2016/06/25/786529_people_512x512.png" alt=" " class="img-responsive"></a>
										@endif
									</div>
									<div class="comments-grid-right">
										@if(auth()->user() != $comment->user)
											<a href="{{ route('view', ['user' => $comment->user]) }}"><h5>
											</h5>{{ $comment->user->name }}</a>
										@endif
										<ul>
											<li>{{ $comment->created_at->diffForHumans() }} </li>
											@if(auth()->user() == $comment->user)
												<li><i>|</i><a style="cursor: pointer;" onclick="editComment(this)">Edit</a></li>
												<li><i>|</i><a style="cursor: pointer;" onclick="deleteComment(this)">Delete</a>{{-- <a href="{{ route('comment.delete', ['comment' => $comment]) }}"></a> --}}<p style="display: none;" id="comment_id">{{ $comment->id }}</p></li>
											@endif
											{{-- <li><a href="#">Reply</a></li> --}}
										</ul>
										<p id="commentbody">{{ $comment->comment_body }}</p>
										@if(auth()->user() == $comment->user)
											<div id="formEditComment" style="display: none;">
												<input class="form-control" type="text" id="editbox" name="comment_body" placeholder="Comment" requred><br>
												<input class="btn btn-success" type="button" onclick="saveCommentEdit(this)" value="save"> <input class="btn btn-danger" type="button" value="cancel" onclick="disableEditComment(this)">
											</div>
										@endif
										<hr>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="clearfix"> </div>
								</div>
							@endforeach
						@else
							<p style="font-style: italic;">No comments yet</p>
						@endif
						<div id="snackbar"></div>
					</div>
				</div>
				<div class="leave-coment-form" style="background: white; padding: 10px;">
					<h3>Leave Your Comment</h3>
					<form action="{{ route('comment', ['post' => $post]) }}" method="post">
						{{ csrf_field() }}
						<textarea name="comment_body" placeholder="Your comment here..." required=""></textarea>
						<div class="w3_single_submit">
							<input type="submit" value="Comment" >
						</div>
					</form>
				</div>
			</div>
		</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ secure_asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('js/myjs.js') }}"></script>
<script type="text/javascript">

	/*  some globals   */
	var deleteRoute = "{{ route('delete.comment') }}";
	var editRoute = "{{ route('edit.comment') }}";

	var addCommentRoute = "{{ route('add.comment') }}";
	var postid = "{{ $post->id }}";
	var token = "{{Session::token()}}";

	function confirmDelete(element){
		if(confirm('Are you sure you want to delete this post? You CANNOT UNDO this') == true){
			var link = element.parentNode.lastChild;
			$(link)[0].click();
		}
	}

	function addComment(element){
		var textarea = element.parentNode.parentNode.querySelector("textarea");
		var comment_body = textarea.value;

		if(comment_body != ""){
			$.post(addCommentRoute, {'postid': postid, 'comment_body': comment_body, '_token': token}, function(data) {
				console.log(data);
			});
		}else{
			$(textarea).focus();
		}
	}
</script>

@endsection