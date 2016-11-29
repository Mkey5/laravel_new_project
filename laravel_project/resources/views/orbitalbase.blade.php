@extends('layouts.app')

@section('content')
	<script src="/js/jquery-3.1.1.min.js"></script>
	<script src="/js/jquery.countdown.js"></script>
	<style type="text/css">
		.disabled:hover{
			cursor: pointer;
		}
	</style>

	<div class="container">
		
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<h2 >Shipyard :</h2>
						<img src="/images/shipyard.jpg" style="border-radius: 20px">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3>Shipyard level: <b>{{ $user->orbitalbase->shipyard->level }}</b></h3>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : <b>{{ $user->orbitalbase->shipyard->cost_gold }}</b></p>
						<p>Metal : <b>{{ $user->orbitalbase->shipyard->cost_metal }}</b></p>
						<p>Energy : <b>{{ $user->orbitalbase->shipyard->cost_energy }}</b></p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/orbitalbase') }}">
							
							<input id="shipyard_upgrating" type="hidden" class="" name="shipyard_upgrating" value="shipyard_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if((($user->homeplanet->gold < $user->orbitalbase->shipyard->cost_gold) ||
    							($user->homeplanet->metal < $user->orbitalbase->shipyard->cost_metal) ||
    							($user->homeplanet->energy < $user->orbitalbase->shipyard->cost_energy)) && ($user->orbitalbase->shipyard->frigate_time == null))

    							<div class="alert alert-danger" style="text-align: center;">
  									You haven't got enough resources to upgrade
								</div>
							@elseif ($user->orbitalbase->shipyard->upgrating_time != null)
	                            <?php 

	                            	$time_shipyard = $user->orbitalbase->shipyard->upgrating_time;
	                            	$year_shipyard = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_shipyard)->format('Y');
	                            	$month_shipyard = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_shipyard)->format('m');
	                            	$day_shipyard = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_shipyard)->format('d');
	                            	$hour_shipyard = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_shipyard)->format('H');
	                            	$minute_shipyard = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_shipyard)->format('i');
	                            	$second_shipyard = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_shipyard)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_shipyard"></span>
								</div>
								<script type="text/javascript">

									$('#clock_shipyard').countdown('{{ $year_shipyard }}/{{ $month_shipyard }}/{{ $day_shipyard }} {{ $hour_shipyard }}:{{ $minute_shipyard }}:{{ $second_shipyard }}')
										.on('update.countdown', function(event) {
										  var format = '%H:%M:%S';
										  if(event.offset.totalDays > 0) {
										    format = '%-d day%!d ' + format;
										  }
										  if(event.offset.weeks > 0) {
										    format = '%-w week%!w ' + format;
										  }
										  $(this).html(event.strftime(format));
										})
										.on('finish.countdown', function(event) {
										  $(this).html('The building is upgrated!')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>


	                        @else
	                        	<button type="submit" class="btn btn-primary">Upgrade</button>
	                        @endif
						</form>

					</div>
				</div>
				
			</div>
			
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<h2 >Docks :</h2>
				<div class="row">
					<div class="col-md-9">
						<img src="/images/frigate.jpg" style="border-radius: 10px">
					</div>
					<div class="col-md-3">
						<p>Level Needed: <b>{{ $ships['frigate']['levelneeded'] }}</b></p>
						<p>Attack: <b>{{ $ships['frigate']['attack'] }}</b></p>
						<p>Defence: <b>{{ $ships['frigate']['defence'] }}</b></p>
						<p>Gold: <b>{{ $ships['frigate']['cost_gold'] }}</b></p>
						<p>Metal: <b>{{ $ships['frigate']['cost_metal'] }}</b></p>
						<p>Energy: <b>{{ $ships['frigate']['cost_energy'] }}</b></p>
						

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/orbitalbase') }}">
							
							<input id="create_frigate" type="hidden" class="" name="create_frigate" value="create_frigate">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input class="form-control" name="number_ships" value="" type="number" min="0"  max="5" style="width: 70px;">
							<br>
							@if($ships['frigate']['levelneeded'] > $user->orbitalbase->shipyard->level)
								<div class="alert alert-danger" style="text-align: center;">
  									Level {{ $ships['frigate']['levelneeded'] }} Shipyard needed
								</div>
							@elseif((($user->homeplanet->gold < $ships['frigate']['cost_gold']) ||
    							($user->homeplanet->metal < $ships['frigate']['cost_metal'] ) ||
    							($user->homeplanet->energy < $ships['frigate']['cost_energy'] )) && ($user->orbitalbase->shipyard->frigate_time == null))

    							<div class="alert alert-danger" style="text-align: center;">
  									Not enough resources
								</div>
							@elseif ($user->orbitalbase->shipyard->frigate_time != null)
	                            <?php 

	                            	$time_frigate = $user->orbitalbase->shipyard->frigate_time;
	                            	$year_frigate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_frigate)->format('Y');
	                            	$month_frigate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_frigate)->format('m');
	                            	$day_frigate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_frigate)->format('d');
	                            	$hour_frigate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_frigate)->format('H');
	                            	$minute_frigate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_frigate)->format('i');
	                            	$second_frigate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_frigate)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_frigate"></span>
								</div>
								<script type="text/javascript">

									$('#clock_frigate').countdown('{{ $year_frigate }}/{{ $month_frigate }}/{{ $day_frigate }} {{ $hour_frigate }}:{{ $minute_frigate }}:{{ $second_frigate }}')
										.on('update.countdown', function(event) {
										  var format = '%H:%M:%S';
										  if(event.offset.totalDays > 0) {
										    format = '%-d day%!d ' + format;
										  }
										  if(event.offset.weeks > 0) {
										    format = '%-w week%!w ' + format;
										  }
										  $(this).html(event.strftime(format));
										})
										.on('finish.countdown', function(event) {
										  $(this).html('The building is upgrated!')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>


	                        @else
	                        	<br>
	                        	<button type="submit" class="btn btn-primary" style="width: 70px;">Build</button>
	                        @endif
						</form>

					</div>
				</div>
				<br>

			</div>
			<!-- for alerts when the user tries to build more than he could afford to pay -->
			@if(isset($errorBuild))
				<div class="alert alert-warning alert-dismissable fade in" style="text-align: right;">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Warning!</strong> {{ $errorBuild }}
			  </div>
			@endif

			<script type="text/javascript">
				

				$(function(){
					// replacing the false symbols
					$(':input[type="number"]').on('keyup', function() {
					  this.value = this.value.replace(/[^0-9\.]/g,'');
					});

					$(':input[type="number"]').on('change', function(){
						//this is for second check , becaouse of the bug with the float numbers ;)
						var currentValue = this.value;
						 if($.isNumeric(currentValue) && Math.floor(currentValue) == currentValue){
						 	// with + we cast the number so that we remove 0 if existing (005 = 5) ;)
						 	this.value = +this.value;
						 	if(this.value > 5){
						 		this.value = 5 ;
						 	}
						 }else{
						 	this.value = 0 ;
						 }


						 // console.log(this.value);
					});
				});

			</script>
		</div>
	</div>
	<br>
	<br>




@endsection