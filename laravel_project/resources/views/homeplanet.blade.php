@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<!-- <img src=""> -->
						Gold Mine
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
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
							@if ($user->homeplanet->goldmine->upgrating_time != null)
	                            <?php echo "TIMER STARTED"; ?>
	                        @else
	                        	<button type="submit" class="btn btn-primary">Upgrade</button>
	                        @endif
						</form>

					</div>
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<!-- <img src=""> -->
						Metal Mine
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>Metal income per 2 minutes: {{ $user->homeplanet->metalmine->income }}</p>
						<p>Metalmine level: {{ $user->homeplanet->metalmine->level }}</p>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : {{ $user->homeplanet->metalmine->cost_gold }}</p>
						<p>Metal : {{ $user->homeplanet->metalmine->cost_metal }}</p>
						<p>Energy : {{ $user->homeplanet->metalmine->cost_energy }}</p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/homeplanet') }}">
							{{ csrf_field() }}
							<input id="metal_upgrating" type="hidden" class="" name="metal_upgrating" value="metal_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if ($user->homeplanet->metalmine->upgrating_time != null)
	                            <?php echo "TIMER STARTED"; ?>
	                        @else
	                        	<button type="submit" class="btn btn-primary">Upgrade</button>
	                        @endif
						</form>

					</div>
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<!-- <img src=""> -->
						Power Plant
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>Energy income per 2 minutes: {{ $user->homeplanet->powerplant->income }}</p>
						<p>Power Plant level: {{ $user->homeplanet->powerplant->level }}</p>
						
						<h3>Upgrade costs:</h3>
						<p>Gold : {{ $user->homeplanet->powerplant->cost_gold }}</p>
						<p>Metal : {{ $user->homeplanet->powerplant->cost_metal }}</p>
						<p>Energy : {{ $user->homeplanet->powerplant->cost_energy }}</p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/homeplanet') }}">
							{{ csrf_field() }}
							<input id="energy_upgrating" type="hidden" class="" name="energy_upgrating" value="energy_upgrating">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@if ($user->homeplanet->powerplant->upgrating_time != null)
	                            <?php echo "TIMER STARTED"; ?>
	                        @else
	                        	<button type="submit" class="btn btn-primary">Upgrade</button>
	                        @endif
						</form>

					</div>
				</div>
				
			</div>
		</div>
		
	</div>


@endsection