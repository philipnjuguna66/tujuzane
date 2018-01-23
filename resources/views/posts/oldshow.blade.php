@extends('layouts.app')

@section('pageTitle', 'View Post')
@section('content')

<div class="container">

	<div class="row">
		
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">{{ $post->post_title }}</h4>
				</div>
				<div class="panel-body">
					<p>{{ $post->post_body }}</p>
					<?php 
						if($post->user_id != Auth::user()->user_id){
							$whoPosted = App\User::find($post->user_id);
							?>
							<p style="font-size: 12px;">posted by <a href="{{ url('users', [$post->user_id]) }}">{{ $whoPosted->name }}</a> {{ $post->created_at->diffForHumans() }}</p>
							<?php
						}
					?>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<form class="form-inline" method="POST" action="{{ url('posts', [$post->post_id, 'comment']) }}">
						{{ csrf_field() }}
						<span style="margin-right: 20%;" class="panel-title">Comments</span>
						<div class="form-group">
							<textarea class="form-control" name="comment_body" placeholder="Comment here..." rows="1" cols="50" required></textarea>
							<button class="btn btn-info" type="submit">Comment</button>
						</div>
					</form>
				</div>
				<div class="panel-body">
					@if(count($post->comments))
						@foreach($post->comments as $comment)
							<p style="font-size: 12px;">{{ $comment->comment_body }}</p>
							<?php 
								if($comment->user_id != Auth::user()->user_id){
									$whoCommented = App\User::find($comment->user_id);
									?>
									<p style="font-size: 10px;">by <a href="{{ url('users', [$comment->user_id]) }}">{{ $whoCommented->name }}</a> {{ $comment->created_at->diffForHumans() }}</p>
									<?php
								}else{
									?>
									<p style="font-size: 10px;">by <a href="{{ url('viewme') }}">me</a> {{ $comment->created_at->diffForHumans() }}</p>
									<?php
								}
							?>
							<hr>
						@endforeach
					@else
						<p style="font-size: 10px; font-style: italic; text-align: center;">Be the first to comment</p>
					@endif
				</div>
			</div>
		</div>
	</div>

</div>

@endsection