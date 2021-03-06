@extends('layouts.app')

@section('content')
	<link rel="icon" href="/solardomination/public/favicon.ico">
	<style type="text/css">
		html{
	        height: 100%;
	        width: 100%;
	    }
	    body{
	        height: 100%;
	        width: 100%;
	        background:#000000 url('/solardomination/public/images/battlestation.jpg') no-repeat scroll center center / cover;
	        background-attachment: fixed;
	    }

		.disabled:hover{
			cursor: pointer;
		}

		.transp-back{
			background-color: rgba(242, 242, 242, 0.4);
		}
		.back{
			background-color: rgba(242, 242, 242, 0.9);
			padding-top: 5px;
			height: 100%;
		}
		.battlestation{
			background-color: rgba(140, 140, 140, 0.9);
		}

		th{
			color: white;
		}

		select{
			width: 120px !important;
			display: inline-block !important;
			margin-bottom: 10px !important;
		}

		.planet{
			margin-top: 10px;
			display: none;
		}

		@media screen and (max-width: 790px) {
	        table {
	            margin-left: -12px;
	        }
	        .attack{
	        	margin-bottom: 10px;
	        }
	    }

	</style>

	@if($battleInProgress == true && $user->fleet->state == 'ready')
		<script type="text/javascript">
		    window.location = "{{ url('/battleinprogress') }}";// redirect if battle in progress
		</script>
	@endif

	<div class="container transp-back">
		<div class="row">
			<div class="col-md-6">
				@if($defender->homeplanet->x <= 10)
				<img src="/solardomination/public/images/defenderplanet1.png" class="img-responsive planet">
				@elseif ($defender->homeplanet->x <= 20)
				<img src="/solardomination/public/images/defenderplanet2.png" class="img-responsive planet">
				@elseif ($defender->homeplanet->x <= 30)
				<img src="/solardomination/public/images/defenderplanet3.png" class="img-responsive planet">
				@else
				<img src="/solardomination/public/images/defenderplanet4.png" class="img-responsive planet">
				@endif
			</div>
			<div class="col-md-6 back">
				<div class="row">
					<div class="col-md-12">
						<h3>Planet name : <b>{{ $defender->homeplanet->name }}</b></h3>
						<p>Coordinates : <b>X-{{ $defender->homeplanet->x }} Y-{{ $defender->homeplanet->y }}</b></p>
						<p>Galaxy : <b>{{ $defender->homeplanet->galaxy }}</b></p>
						<p>Gold : <b>N/A</b></p>
						<p>Metal : <b>N/A</b></p>
						<p>Energy : <b>N/A</b></p>
						<p>Fleet defence capability : <b>N/A</b></p>
						<p>Range : <b>in range</b></p>
						<p>Travel time : approximately <b>{{ $defender_time_range }} minutes</b></p>
					</div>
				</div>
				
				<div class="row battlestation">
					<div class="col-md-12">
						<h2>Battle Station</h2>
						<table class="table table-striped">
			                <thead>
			                    <tr>
			                        <th>Docks:</th>
			                        <th>Frigates</th>
			                        <th>Corvettes</th>
			                        <th>Destroyers</th>
			                        <th>Assault Carriers</th>
			                    </tr>
			                </thead>
			                <tbody>
			                    <tr>
			                        <td>
			                            <img src="/solardomination/public/images/orbitalbase.jpg" style="height:32px; width: 32px; border-radius: 50%;">
			                        </td>
			                        <td>
			                            <img src="/solardomination/public/images/frigate.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->orbitalbase->frigates }}</b>
			                        </td>
			                        <td>
			                            <img src="/solardomination/public/images/corvette.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->orbitalbase->corvettes }}</b>
			                        </td>
			                        <td>
			                            <img src="/solardomination/public/images/destroyer.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->orbitalbase->destroyers }}</b>
			                        </td>
			                       	<td>
			                            <img src="/solardomination/public/images/assaultcarrier.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->orbitalbase->assaultcarriers }}</b>
			                        </td>
			                    </tr>
			                </tbody>
			            </table>
					</div>
				</div>
				<div class="row battlestation">
					<div class="col-md-6">
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/battlestation') }}/{{ $defender->id }}">
							
							<input id="prepare_fleet" type="hidden" class="" name="prepare_fleet" value="prepare_fleet">

						    
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if($user->fleet->state == 'ready')
    							<table class="table table-striped">
					                <thead>
					                    <tr>
					                        <th>Fleet:</th>
					                        <th>Attack</th>
					                        <th>Defence</th>
					                    </tr>
					                </thead>
					                <tbody>
					                    <tr>
					                        <td>
					                            <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; border-radius: 50%;">
					                        </td>
					                        <td>
					                             <b>{{ $user->fleet->attack }}</b>
					                        </td>
					                        <td>
					                             <b>{{ $user->fleet->defence }}</b>
					                        </td>
					                    </tr>
					                </tbody>
					            </table>
    							
							@elseif (
								($user->orbitalbase->frigates < 1) &&
    							($user->orbitalbase->corvettes < 1) &&
    							($user->orbitalbase->destroyers < 1) &&
    							($user->orbitalbase->assaultcarriers < 1)
								)
	                            <div class="alert alert-danger">
  									You haven't got any ship for your fleet
								</div>
	                        @else

	                        	<select class="form-control" name="frigates" id="frigates" required autofocus>
		                            <option selected disabled>- frigates -</option>
		                            <option value="0">0</option>
		                            @for ($i = 1; $i <= $user->orbitalbase->frigates; $i++)
									    <option value="{{ $i }}">{{ $i }}</option>
									@endfor
		                        </select>
		                        <select class="form-control" name="corvettes" id="corvettes" required autofocus>
		                            <option selected disabled>- corvettes -</option>
		                            <option value="0">0</option>
		                            @for ($i = 1; $i <= $user->orbitalbase->corvettes; $i++)
									    <option value="{{ $i }}">{{ $i }}</option>
									@endfor
		                        </select>
		                        <select class="form-control" name="destroyers" id="destroyers" required autofocus>
		                            <option selected disabled>- destroyers -</option>
		                            <option value="0">0</option>
		                            @for ($i = 1; $i <= $user->orbitalbase->destroyers; $i++)
									    <option value="{{ $i }}">{{ $i }}</option>
									@endfor
		                        </select>
		                        <select class="form-control" name="assaultcarriers" id="assaultcarriers" required autofocus>
		                            <option selected disabled>- carriers -</option>
		                            <option value="0">0</option>
		                            @for ($i = 1; $i <= $user->orbitalbase->assaultcarriers; $i++)
									    <option value="{{ $i }}">{{ $i }}</option>
									@endfor
		                        </select>

	                        	<button type="submit" class="btn btn-warning">Prepare Fleet &nbsp;<i class="glyphicon glyphicon-record"></i></button>
	                        	<br>
	                        @endif
	                   
							<br>
						</form>
					</div>
					<div class="col-md-3">
						@if($user->fleet->state == 'ready')
						<form class="form-horizontal" role="form" id="abort_form" method="POST" action="{{ url('/battlestation') }}/{{ $defender->id }}">
							
							<input id="abort" type="hidden" class="" name="abort" value="abort">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<br>
							<br>	
							<button type="submit" class="btn btn-primary">Abort &nbsp;<i class="glyphicon glyphicon-remove"></i></button>
	                         	
							<br>
						</form>
						@endif
					</div>
					<div class="col-md-3">
						@if($user->fleet->state == 'ready' && $user->fleet->attack != 0)
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/battlestation') }}/{{ $defender->id }}">
							
							<input id="attack" type="hidden" class="" name="attack" value="attack">
							<input type="hidden" name="defender_id" value="{{ $defender->id }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
    							<br>
								<br>
	                        	<button type="submit" class="btn btn-danger attack">Attack &nbsp;<i class="glyphicon glyphicon-fire"></i></button>
	                        
							<br>
						</form>
						@endif
					</div>
					
				</div>

			</div>
		</div>
		<br>
		<br>
		<br>
	</div>

	<!-- this is for updating the page , when the user comes again from radar -->
	<?php 
		session_start();
	?>

	@if($_SESSION["fleet"] != 0)
	<script type="text/javascript">
		if({{ $_SESSION["fleet"] }} == 1 && {{ $_SESSION["radar"] }} == 1){
			     $("#abort_form").submit();
		}
	</script>
	@endif
	<script type="text/javascript">
		$(function(){
	       $('.planet').fadeIn(3000);
	    });
	</script>
	


@endsection