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
				<img src="/images/orbitalbase_big.jpg" style="height:300px; width: 300px; border-radius: 50%;">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<h2 >Shipyard</h2>
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
							{{ csrf_field() }}
							<input id="shipyard_upgrating" type="hidden" class="" name="shipyard_upgrating" value="shipyard_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if(($user->homeplanet->gold < $user->orbitalbase->shipyard->cost_gold) &&
    							($user->homeplanet->metal < $user->orbitalbase->shipyard->cost_metal) &&
    							($user->homeplanet->energy < $user->orbitalbase->shipyard->cost_energy))

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
	</div>
	<br>
	<br>




@endsection