<div class="container">
	
	<div class="row">
		<div class="col-md-2"></div>

		<div class="col-md-8">
			
			@if ($errors->any())
		        <div class="alert alert-danger alert-dismissable">
		          <a class="panel-close close" data-dismiss="alert">×</a>
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
		          
		        </div>
			@endif

			@if(Session::has('message'))
				<div class="flash-message alert alert-success alert-dismissable">
		          <a class="panel-close close" data-dismiss="alert">×</a>
		          {{ Session::get('message') }}
		        </div>
			@endif
			
		</div>
	</div>

</div>