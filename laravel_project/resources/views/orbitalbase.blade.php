@extends('layouts.app')

@section('content')
	<script src="/solardomination/public/js/jquery-3.1.1.min.js"></script>
	<script src="/solardomination/public/js/jquery.countdown.js"></script>
	
	<style type="text/css">
		
		html{
	        height: 100%;
	        width: 100%;
	    }
	    body{
	        height: 100%;
	        width: 100%;
	        background:#000000 url('/solardomination/public/images/orbitalbase_back.jpg') no-repeat scroll center center / cover;
	        background-attachment: fixed;
	        color: white;
	    }
	    table{
	    	color: gray;
	    }

	    .transp-back{
			background-color: rgba(120, 120, 120, 0.4);
		}

    	.disabled:hover{
			cursor: pointer;
		}

		h2{
			margin-left: 10px;
		}

		th{
			color: white;
		}

		td{
			color: black;
			font-weight: bold;
			font-size: 15px;
		}
		.img-responsive{
			display: none;
		}

		@media screen and (max-width: 790px) {
	        table {
	            margin-left: -12px;
	        }
	        .img-responsive{
	        	display: block;
	        }
	    }

	</style>
	
	<div class="container transp-back">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Home Planet:</th>
                        <th>Gold</th>
                        <th>Metal</th>
                        <th>Energy</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="position: relative;">
                            <img src="/solardomination/public/images/homeplanet.png" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td>
                            <img src="/solardomination/public/images/gold.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->homeplanet->gold }}</b>
                        </td>
                        <td>
                            <img src="/solardomination/public/images/metal.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->homeplanet->metal }}</b>
                        </td>
                        <td>
                            <img src="/solardomination/public/images/energy.jpg" style="height:32px; width: 32px; border-radius: 50%;"> <b>{{ $user->homeplanet->energy }}</b>
                        </td>
                       
                    </tr>
                </tbody>
            </table>
			</div>
		</div>
		<br>
		<div class="row">
			
			<!-- for alerts when the user tries to build more than he could afford to pay -->
			@if(isset($errorBuild))
				<div class="alert alert-warning alert-dismissable fade in" style="text-align: center;">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Warning!</strong> {{ $errorBuild }}
			  </div>
			@endif
			<div class="col-md-12">
				<h3 >Docks :</h3>
				<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Docked ships:</th>
                        <th>Frigates</th>
                        <th>Corvettes</th>
                        <th>Destroyers</th>
                        <th>Assault Carriers</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="position: relative; width: 130px;">
                            <img src="/solardomination/public/images/orbitalbase.jpg" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td><b>{{ $user->orbitalbase->frigates }}</b></td>
                        <td><b>{{ $user->orbitalbase->corvettes }}</b></td>
                        <td><b>{{ $user->orbitalbase->destroyers }}</b></td>
                        <td><b>{{ $user->orbitalbase->assaultcarriers }}</b></td>
                    </tr>
                </tbody>
            </table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<h3 >Fleet :</h3>
				<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fleet Status:</th>
                        <th>Frigates</th>
                        <th>Corvettes</th>
                        <th>Destroyers</th>
                        <th>Assault Carriers</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="position: relative; width: 130px;">
                            <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td>{{ $user->fleet->frigate }}</td>
                        <td>{{ $user->fleet->corvette }}</td>
                        <td>{{ $user->fleet->destroyer }}</td>
                        <td>{{ $user->fleet->assault_carrier }}</td>
                    </tr>
                </tbody>
            </table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-9">
						<img src="/solardomination/public/images/frigate.jpg" class="img-responsive" style="border-radius: 10px">
						<h3>Frigate</h3>
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
							<input class="form-control" name="number_ships" title="max 5 ships" value="" type="number" min="0"  max="5" style="width: 70px;">
							<br>
							@if($ships['frigate']['levelneeded'] > $user->orbitalbase->shipyard->level)
								<div class="alert alert-danger" style="text-align: center;">
  									Level {{ $ships['frigate']['levelneeded'] }} Shipyard needed
								</div>
							
							@elseif ($user->orbitalbase->shipyard->frigate_time != '0001-01-01 00:00:00')
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
										  $(this).html('The ships are ready! Click to refresh page.')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>

							@elseif((($user->homeplanet->gold < $ships['frigate']['cost_gold']) ||
    							($user->homeplanet->metal < $ships['frigate']['cost_metal'] ) ||
    							($user->homeplanet->energy < $ships['frigate']['cost_energy'] )) && ($user->orbitalbase->shipyard->frigate_time == '0001-01-01 00:00:00'))

    							<div class="alert alert-danger" style="text-align: center;">
  									Not enough resources
								</div>
	                        @else
	                        	<br>
	                        	<button type="submit" class="btn btn-primary" style="width: 70px;">Build</button>
	                        @endif
						</form>

					</div>
				</div>
				<br>

			</div>
			


			<div class="col-md-6">
				<div class="row">
					<div class="col-md-9">
						<img src="/solardomination/public/images/corvette.jpg" class="img-responsive" style="border-radius: 10px">
						<h3>Corvette</h3>
					</div>
					<div class="col-md-3">
						<p>Level Needed: <b>{{ $ships['corvette']['levelneeded'] }}</b></p>
						<p>Attack: <b>{{ $ships['corvette']['attack'] }}</b></p>
						<p>Defence: <b>{{ $ships['corvette']['defence'] }}</b></p>
						<p>Gold: <b>{{ $ships['corvette']['cost_gold'] }}</b></p>
						<p>Metal: <b>{{ $ships['corvette']['cost_metal'] }}</b></p>
						<p>Energy: <b>{{ $ships['corvette']['cost_energy'] }}</b></p>
						

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/orbitalbase') }}">
							
							<input id="create_corvette" type="hidden" class="" name="create_corvette" value="create_corvette">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input class="form-control" name="number_ships" title="max 5 ships" value="" type="number" min="0"  max="5" style="width: 70px;">
							<br>
							@if($ships['corvette']['levelneeded'] > $user->orbitalbase->shipyard->level)
								<div class="alert alert-danger" style="text-align: center;">
  									Level {{ $ships['corvette']['levelneeded'] }} Shipyard needed
								</div>
							@elseif ($user->orbitalbase->shipyard->corvette_time != '0001-01-01 00:00:00')
	                            <?php 

	                            	$time_corvette = $user->orbitalbase->shipyard->corvette_time;
	                            	$year_corvette = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_corvette)->format('Y');
	                            	$month_corvette = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_corvette)->format('m');
	                            	$day_corvette = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_corvette)->format('d');
	                            	$hour_corvette = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_corvette)->format('H');
	                            	$minute_corvette = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_corvette)->format('i');
	                            	$second_corvette = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_corvette)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_corvette"></span>
								</div>
								<script type="text/javascript">

									$('#clock_corvette').countdown('{{ $year_corvette }}/{{ $month_corvette }}/{{ $day_corvette }} {{ $hour_corvette }}:{{ $minute_corvette }}:{{ $second_corvette }}')
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
										  $(this).html('The ships are ready! Click to refresh page.')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>

							@elseif((($user->homeplanet->gold < $ships['corvette']['cost_gold']) ||
    							($user->homeplanet->metal < $ships['corvette']['cost_metal'] ) ||
    							($user->homeplanet->energy < $ships['corvette']['cost_energy'] )) && ($user->orbitalbase->shipyard->corvette_time == '0001-01-01 00:00:00'))

    							<div class="alert alert-danger" style="text-align: center;">
  									Not enough resources
								</div>
	                        @else
	                        	<br>
	                        	<button type="submit" class="btn btn-primary" style="width: 70px;">Build</button>
	                        @endif
						</form>

					</div>
				</div>
				<br>

			</div>

			
		</div>
		<br>





		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-9">
						<img src="/solardomination/public/images/destroyer.jpg" class="img-responsive" style="border-radius: 10px">
						<h3>Destroyer</h3>
					</div>
					<div class="col-md-3">
						<p>Level Needed: <b>{{ $ships['destroyer']['levelneeded'] }}</b></p>
						<p>Attack: <b>{{ $ships['destroyer']['attack'] }}</b></p>
						<p>Defence: <b>{{ $ships['destroyer']['defence'] }}</b></p>
						<p>Gold: <b>{{ $ships['destroyer']['cost_gold'] }}</b></p>
						<p>Metal: <b>{{ $ships['destroyer']['cost_metal'] }}</b></p>
						<p>Energy: <b>{{ $ships['destroyer']['cost_energy'] }}</b></p>
						

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/orbitalbase') }}">
							
							<input id="create_destroyer" type="hidden" class="" name="create_destroyer" value="create_destroyer">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input class="form-control" name="number_ships" title="max 5 ships" value="" type="number" min="0"  max="5" style="width: 70px;">
							<br>
							@if($ships['destroyer']['levelneeded'] > $user->orbitalbase->shipyard->level)
								<div class="alert alert-danger" style="text-align: center;">
  									Level {{ $ships['destroyer']['levelneeded'] }} Shipyard needed
								</div>
							@elseif ($user->orbitalbase->shipyard->destroyer_time != '0001-01-01 00:00:00')
	                            <?php 

	                            	$time_destroyer = $user->orbitalbase->shipyard->destroyer_time;
	                            	$year_destroyer = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_destroyer)->format('Y');
	                            	$month_destroyer = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_destroyer)->format('m');
	                            	$day_destroyer = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_destroyer)->format('d');
	                            	$hour_destroyer = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_destroyer)->format('H');
	                            	$minute_destroyer = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_destroyer)->format('i');
	                            	$second_destroyer = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_destroyer)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_destroyer"></span>
								</div>
								<script type="text/javascript">

									$('#clock_destroyer').countdown('{{ $year_destroyer }}/{{ $month_destroyer }}/{{ $day_destroyer }} {{ $hour_destroyer }}:{{ $minute_destroyer }}:{{ $second_destroyer }}')
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
										  $(this).html('The ships are ready! Click to refresh page.')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>

							@elseif((($user->homeplanet->gold < $ships['destroyer']['cost_gold']) ||
    							($user->homeplanet->metal < $ships['destroyer']['cost_metal'] ) ||
    							($user->homeplanet->energy < $ships['destroyer']['cost_energy'] )) && ($user->orbitalbase->shipyard->destroyer_time == '0001-01-01 00:00:00'))

    							<div class="alert alert-danger" style="text-align: center;">
  									Not enough resources
								</div>
	                        @else
	                        	<br>
	                        	<button type="submit" class="btn btn-primary" style="width: 70px;">Build</button>
	                        @endif
						</form>

					</div>
				</div>
				<br>

			</div>
			


			<div class="col-md-6">
				<div class="row">
					<div class="col-md-9">
						<img src="/solardomination/public/images/assaultcarrier.jpg" class="img-responsive" style="border-radius: 10px">
						<h3>Assault Carrier</h3>
					</div>
					<div class="col-md-3">
						<p>Level Needed: <b>{{ $ships['assaultcarrier']['levelneeded'] }}</b></p>
						<p>Attack: <b>{{ $ships['assaultcarrier']['attack'] }}</b></p>
						<p>Defence: <b>{{ $ships['assaultcarrier']['defence'] }}</b></p>
						<p>Gold: <b>{{ $ships['assaultcarrier']['cost_gold'] }}</b></p>
						<p>Metal: <b>{{ $ships['assaultcarrier']['cost_metal'] }}</b></p>
						<p>Energy: <b>{{ $ships['assaultcarrier']['cost_energy'] }}</b></p>
						

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/orbitalbase') }}">
							
							<input id="create_assaultcarrier" type="hidden" class="" name="create_assaultcarrier" value="create_assaultcarrier">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input class="form-control" name="number_ships" title="max 5 ships" value="" type="number" min="0"  max="5" style="width: 70px;">
							<br>
							@if($ships['assaultcarrier']['levelneeded'] > $user->orbitalbase->shipyard->level)
								<div class="alert alert-danger" style="text-align: center;">
  									Level {{ $ships['assaultcarrier']['levelneeded'] }} Shipyard needed
								</div>
							@elseif ($user->orbitalbase->shipyard->assaultcarrier_time != '0001-01-01 00:00:00')
	                            <?php 

	                            	$time_assaultcarrier = $user->orbitalbase->shipyard->assaultcarrier_time;
	                            	$year_assaultcarrier = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_assaultcarrier)->format('Y');
	                            	$month_assaultcarrier = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_assaultcarrier)->format('m');
	                            	$day_assaultcarrier = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_assaultcarrier)->format('d');
	                            	$hour_assaultcarrier = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_assaultcarrier)->format('H');
	                            	$minute_assaultcarrier = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_assaultcarrier)->format('i');
	                            	$second_assaultcarrier = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_assaultcarrier)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_assaultcarrier"></span>
								</div>
								<script type="text/javascript">

									$('#clock_assaultcarrier').countdown('{{ $year_assaultcarrier }}/{{ $month_assaultcarrier }}/{{ $day_assaultcarrier }} {{ $hour_assaultcarrier }}:{{ $minute_assaultcarrier }}:{{ $second_assaultcarrier }}')
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
										  $(this).html('The ships are ready! Click to refresh page.')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>

							@elseif((($user->homeplanet->gold < $ships['assaultcarrier']['cost_gold']) ||
    							($user->homeplanet->metal < $ships['assaultcarrier']['cost_metal'] ) ||
    							($user->homeplanet->energy < $ships['assaultcarrier']['cost_energy'] )) && ($user->orbitalbase->shipyard->assaultcarrier_time == '0001-01-01 00:00:00'))

    							<div class="alert alert-danger" style="text-align: center;">
  									Not enough resources
								</div>

	                        @else
	                        	<br>
	                        	<button type="submit" class="btn btn-primary" style="width: 70px;">Build</button>
	                        @endif
						</form>

					</div>
				</div>
				<br>

			</div>
			
		</div>
		<br>










		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<h2 >Shipyard :</h2>
						<img src="/solardomination/public/images/shipyard.jpg" class="img-responsive" style="border-radius: 20px">
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
							
							@if ($user->orbitalbase->shipyard->upgrating_time != '0001-01-01 00:00:00')
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
										  $(this).html('The building is upgrated! Click to refresh page.')
										    .parent().addClass('disabled').on('click', function(event){
										    	location.reload();
										    });

										});

								</script>

							@elseif((($user->homeplanet->gold < $user->orbitalbase->shipyard->cost_gold) ||
    							($user->homeplanet->metal < $user->orbitalbase->shipyard->cost_metal) ||
    							($user->homeplanet->energy < $user->orbitalbase->shipyard->cost_energy)) && ($user->orbitalbase->shipyard->upgrating_time == '0001-01-01 00:00:00'))

    							<div class="alert alert-danger" style="text-align: center;">
  									You haven't got enough resources to upgrade
								</div>
								
	                        @else
	                        	<button type="submit" class="btn btn-primary">Upgrade</button>
	                        @endif
						</form>

					</div>
				</div>
				
			</div>
			
		</div>
		<br>


	</div>
	<br>
	<br>

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


					var w = window.innerWidth
                    || document.documentElement.clientWidth
                    || document.body.clientWidth;

	                if( w >= 790){
	                  $('.img-responsive').show(2000);
	                }
					

				});


	</script>


@endsection