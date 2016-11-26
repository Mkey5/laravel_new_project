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
			<div class="col-md-4 col-md-offset-4">
				<img src="/images/homeplanet_big.png" style="height:300px; width: 300px; border-radius: 50%;">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-4">
						<img src="/images/gold.jpg" style=" width: 100px; height: 100px; border-radius: 10%">
						
					</div>
					<div class="col-md-8">
						<h3>Gold Mine</h3>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p>Gold income per 2 minutes: <b>{{ $user->homeplanet->goldmine->income }}</b></p>
						<p>Goldmine level: <b>{{ $user->homeplanet->goldmine->level }}</b></p>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : <b>{{ $user->homeplanet->goldmine->cost_gold }}</b></p>
						<p>Metal : <b>{{ $user->homeplanet->goldmine->cost_metal }}</b></p>
						<p>Energy : <b>{{ $user->homeplanet->goldmine->cost_energy }}</b></p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/homeplanet') }}">
							{{ csrf_field() }}
							<input id="gold_upgrating" type="hidden" class="" name="gold_upgrating" value="gold_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if(($user->homeplanet->gold < $user->homeplanet->goldmine->cost_gold) &&
    							($user->homeplanet->metal < $user->homeplanet->goldmine->cost_metal) &&
    							($user->homeplanet->energy < $user->homeplanet->goldmine->cost_energy))

    							<div class="alert alert-danger">
  									You haven't got enough resources to upgrade
								</div>
							@elseif ($user->homeplanet->goldmine->upgrating_time != null)
	                            <?php 

	                            	$time_gold = $user->homeplanet->goldmine->upgrating_time;
	                            	$year_gold = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_gold)->format('Y');
	                            	$month_gold = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_gold)->format('m');
	                            	$day_gold = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_gold)->format('d');
	                            	$hour_gold = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_gold)->format('H');
	                            	$minute_gold = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_gold)->format('i');
	                            	$second_gold = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_gold)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_gold"></span>
								</div>
								<script type="text/javascript">

									$('#clock_gold').countdown('{{ $year_gold }}/{{ $month_gold }}/{{ $day_gold }} {{ $hour_gold }}:{{ $minute_gold }}:{{ $second_gold }}')
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
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-4">
						<img src="/images/metal.jpg" style=" width: 100px; height: 100px; border-radius: 10%">
						
					</div>
					<div class="col-md-8">
						<h3>Metal Mine</h3>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p>Metal income per 2 minutes: <b>{{ $user->homeplanet->metalmine->income }}</b></p>
						<p>Metalmine level: <b>{{ $user->homeplanet->metalmine->level }}</b></p>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : <b>{{ $user->homeplanet->metalmine->cost_gold }}</b></p>
						<p>Metal : <b>{{ $user->homeplanet->metalmine->cost_metal }}</b></p>
						<p>Energy : <b>{{ $user->homeplanet->metalmine->cost_energy }}</b></p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/homeplanet') }}">
							{{ csrf_field() }}
							<input id="metal_upgrating" type="hidden" class="" name="metal_upgrating" value="metal_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if(($user->homeplanet->gold < $user->homeplanet->metalmine->cost_gold) &&
    							($user->homeplanet->metal < $user->homeplanet->metalmine->cost_metal) &&
    							($user->homeplanet->energy < $user->homeplanet->metalmine->cost_energy))

    							<div class="alert alert-danger">
  									You haven't got enough resources to upgrade
								</div>
							@elseif ($user->homeplanet->metalmine->upgrating_time != null)
	                            <?php 

	                            	$time_metal = $user->homeplanet->metalmine->upgrating_time;
	                            	$year_metal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_metal)->format('Y');
	                            	$month_metal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_metal)->format('m');
	                            	$day_metal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_metal)->format('d');
	                            	$hour_metal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_metal)->format('H');
	                            	$minute_metal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_metal)->format('i');
	                            	$second_metal = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_metal)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_metal"></span>
								</div>
								<script type="text/javascript">

									$('#clock_metal').countdown('{{ $year_metal }}/{{ $month_metal }}/{{ $day_metal }} {{ $hour_metal }}:{{ $minute_metal }}:{{ $second_metal }}')
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
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-4">
						<img src="/images/energy.jpg" style=" width: 100px; height: 100px; border-radius: 10%">
						
					</div>
					<div class="col-md-8">
						<h3>Power Plant</h3>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p>Energy income per 2 minutes: <b>{{ $user->homeplanet->powerplant->income }}</b></p>
						<p>Power Plant level: <b>{{ $user->homeplanet->powerplant->level }}</b></p>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : <b>{{ $user->homeplanet->powerplant->cost_gold }}</b></p>
						<p>Metal : <b>{{ $user->homeplanet->powerplant->cost_metal }}</b></p>
						<p>Energy : <b>{{ $user->homeplanet->powerplant->cost_energy }}</b></p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/homeplanet') }}">
							{{ csrf_field() }}
							<input id="energy_upgrating" type="hidden" class="" name="energy_upgrating" value="energy_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if(($user->homeplanet->gold < $user->homeplanet->powerplant->cost_gold) &&
    							($user->homeplanet->metal < $user->homeplanet->powerplant->cost_metal) &&
    							($user->homeplanet->energy < $user->homeplanet->powerplant->cost_energy))

    							<div class="alert alert-danger">
  									You haven't got enough resources to upgrade
								</div>


							@elseif ($user->homeplanet->powerplant->upgrating_time != null)
	                            
	                            <?php 

	                            	$time_energy = $user->homeplanet->powerplant->upgrating_time;
	                            	$year_energy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_energy)->format('Y');
	                            	$month_energy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_energy)->format('m');
	                            	$day_energy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_energy)->format('d');
	                            	$hour_energy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_energy)->format('H');
	                            	$minute_energy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_energy)->format('i');
	                            	$second_energy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_energy)->format('s');

	                             ?>
	                             <div class="countdown">
								  <span id="clock_energy"></span>
								</div>
								<script type="text/javascript">

									$('#clock_energy').countdown('{{ $year_energy }}/{{ $month_energy }}/{{ $day_energy }} {{ $hour_energy }}:{{ $minute_energy }}:{{ $second_energy }}')
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
		<br>
	</div>


@endsection