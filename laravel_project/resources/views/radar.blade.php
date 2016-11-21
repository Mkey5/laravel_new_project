@extends('layouts.app')

@section('content')
<style type="text/css">

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
		                			<img src="/uploads/avatars/{{ $user->avatar }}" style="height:80px; width: 80px;  top: 10px; left: 10px; border-radius: 50%;">
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
		                    <a class="btn btn-md btn-danger pull-right" href="/battlestation/{{ $user->id }}">Scan Planet</a>
		                </div>
		            </div>
		            <?php $evenNum++; ?>
				@else
					<div class="panel panel-success">
		                <div class="panel-heading">
		                	<div class="row">
		                		<div class="col-md-5">
		                			<img src="/uploads/avatars/{{ $user->avatar }}" style="height:80px; width: 80px;  top: 10px; left: 10px; border-radius: 50%;">
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
		                    <a class="btn btn-md btn-danger pull-right" href="/battlestation/{{ $user->id }}">Scan Planet</a>
		                </div>
		            </div>


		            <?php $evenNum++; ?>
				@endif
			@endforeach
			
			
			{{ $allUsers->links() }}
		</div>

	</div>
		
</div>


@endsection