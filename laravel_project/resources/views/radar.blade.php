@extends('layouts.app')

@section('content')
<?php
	// Start the session
	session_start();
	$_SESSION["radar"] = true;
	$_SESSION["fleet"] = true;
?>
<style type="text/css">

	html{
		height: 100%;
		width: 100%;
	}
	body{
		height: 100%;
		width: 100%;
		background:#000000 url('/solardomination/public/images/radar_bg.jpg') no-repeat scroll center center / cover;
		background-attachment: fixed;
	}
	.panel{
		display: none;
	}

	@media screen and (max-width: 790px) {
	        .panel{
	        	display: block;
	        }
	    }
</style>

<div class="container">
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<?php $evenNum = 2; ?>
			@foreach ($allUsers as $user)
				@if($evenNum % 2 == 0)
					<div class="panel panel-primary">
		                <div class="panel-heading">
		                	<div class="row">
		                		<div class="col-md-5">
		                			<img src="/solardomination/public/uploads/avatars/{{ $user->avatar }}" style="height:80px; width: 80px;  top: 10px; left: 10px; border-radius: 50%;">
		                		</div>
		                		<div class="col-md-7">
		                			<h2 class="panel-title pull-right"><b>{{ $user->nickname }}</b></h3>
		       						<p>Planet: <b>{{ $user->homeplanet_name }}</b></p>
		                			<p>Galaxy: <b>{{ $user->galaxy }}</b></p>		
		                		</div>
		                	</div>
		                	
		                    
		                </div>
		                <div class="panel-body">
		                    <p>Level of development: <b>{{ $user->level }}</b></p>
		                    <p>Coordinates: X:<b>{{ $user->x }}</b> Y:<b>{{ $user->y }}</b></p>
		                    <a class="btn btn-md btn-danger pull-right" href="{{ url('/battlestation') }}/{{ $user->id }}">Scan Planet</a>
		                </div>
		            </div>
		            <?php $evenNum++; ?>
				@else
					<div class="panel panel-success">
		                <div class="panel-heading">
		                	<div class="row">
		                		<div class="col-md-5">
		                			<img src="/solardomination/public/uploads/avatars/{{ $user->avatar }}" style="height:80px; width: 80px;  top: 10px; left: 10px; border-radius: 50%;">
		                		</div>
		                		<div class="col-md-7">
		                			<h2 class="panel-title pull-right"><b>{{ $user->nickname }}</b></h3>
		       						<p>Planet: <b>{{ $user->homeplanet_name }}</b></p>
		                			<p>Galaxy: <b>{{ $user->galaxy }}</b></p>		
		                		</div>
		                	</div>
		                	
		                    
		                </div>
		                <div class="panel-body">
		                    <p>Level of development: <b>{{ $user->level }}</b></p>
		                    <p>Coordinates: X:<b>{{ $user->x }}</b> Y:<b>{{ $user->y }}</b></p>
		                    <a class="btn btn-md btn-danger pull-right" href="{{ url('/battlestation') }}/{{ $user->id }}">Scan Planet</a>
		                </div>
		            </div>


		            <?php $evenNum++; ?>
				@endif
			@endforeach
			
			
			{{ $allUsers->links() }}
		</div>

	</div>
		
</div>

<script type="text/javascript">
	$(function(){
       var w = window.innerWidth
                    || document.documentElement.clientWidth
                    || document.body.clientWidth;

	    if( w >= 790){
	       $('.panel').slideDown(2000);
	    }
    });
</script>


@endsection