@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<link rel="stylesheet" type="text/css" href="css/posts_css.css">

<style type="text/css" media="screen">
	body{
    background:url('../images/bg11.jpg'),no-repeat;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}
</style>

<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			@if(count($posts) > 0)
				@foreach($posts as $post)

					<div class="tc-ch">
						@if(!empty($post->post_photo))
						<div class="tch-img">
							<a href="{{ route('post', ['post' => $post]) }}"><img src="{{ $post->post_photo }}" style="border-radius:5px; max-height: 250px; width: 100%; border-radius: 5px;" class="img-responsive" alt=""/></a>
						</div>
						@endif

						{{-- <a class="blog blue" href="singlepage.html">Technology</a> --}}
						<h3><a href="{{ route('post', ['post' => $post]) }}">{{  $post->post_title }}</a></h3>
							<p>{{ substr($post->post_body, 0, (0.5*(strlen($post->post_body)))) }}.. <a href="{{ route('post', ['post' => $post]) }}">more</a></p>
						
							<div class="blog-poast-info">
								<ul>
									<li><i class="fa fa-user"> </i><a class="admin" href="{{ route('view', ['user' => $post->user]) }}"> 
										@if(Auth::user() == $post->user)
											{{ 'me' }}
										@else
											{{ $post->user->name }}
										@endif
									 </a></li>
									<li><i class="fa fa-calendar"> </i>{{ $post->created_at->diffForHumans() }}</li>
									<li><i class="fa fa-comments"> </i><a class="p-blog" href="{{ route('post.comments', ['post' => $post]) }}">{{count($post->comments)}} Comments</a>
									{{-- <li><i class="glyphicon glyphicon-heart"> </i><a class="admin" href="#">5 favourites </a></li>
									<li><i class="glyphicon glyphicon-eye-open"> </i>1.128 views</li> --}}
								</ul>
							</div>
					</div>
					<div class="clearfix"></div>

				@endforeach
			@else
				<div class="tc-ch">
					There are no articles published.<br>
					Be the first to <a href="{{ route('newpost') }}" title="Make a post">Make an Article</a> on 2juzane Blog!
				</div>
			@endif

		</div>
	</div>
</div>

@endsection