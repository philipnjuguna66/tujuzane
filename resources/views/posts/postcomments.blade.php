@if(count($post->comments) > 0)
	@foreach($post->comments as $comment)
		<div class="comments-grid">
			<div class="comments-grid-left">
				@if(!empty($comment->user->user_photo) && Storage::exists('public'.$comment->user->user_photo))
					<a href="{{ route('view', ['user' => $comment->user]) }}"><img src="{{ asset('storage'.$comment->user->user_photo) }}" alt=" " class="img-responsive" style="max-height: 100px; max-width: 80px;" /></a>
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