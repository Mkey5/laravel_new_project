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
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<!-- <img src=""> -->
						Shipyard
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-md-12">
						<p>Gold income per 2 minutes: {{ $user->homeplanet->goldmine->income }}</p>
						<p>Goldmine level: {{ $user->homeplanet->goldmine->level }}</p>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : {{ $user->homeplanet->goldmine->cost_gold }}</p>
						<p>Metal : {{ $user->homeplanet->goldmine->cost_metal }}</p>
						<p>Energy : {{ $user->homeplanet->goldmine->cost_energy }}</p>
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
				</div> -->
				
			</div>



		</div>
	</div>





@endsection