@extends('layouts.app')

@section('content')
	<script src="/js/jquery-3.1.1.min.js"></script>
	<script src="/js/jquery.countdown.js"></script>
	<style type="text/css">
		html{
	        height: 100%;
	        width: 100%;
	    }
	    body{
	        height: 100%;
	        width: 100%;
	        background: url('/images/battle.jpg') no-repeat scroll center center / cover;
	        background-attachment: fixed;
	    }

		.disabled:hover{
			cursor: pointer;
		}

		h1{
			text-align: center;
			color: white;
			text-shadow: 1px 2px black;
		}
		

		.countdown{
			background-color: rgba(150, 150, 150, 0.7);
			text-align: center;
			border-radius: 10px;
		}
		#clock{
			font-size: 40px;
			font-weight: bold;
			color: red;
			text-shadow: 1px 1px black;
		}
		img{
			display: block;
			margin: 0 auto;
		}
		
	</style>

	<div class="container">
		
		<div class="row">
				<div class="col-md-4 col-md-offset-4 borders">
				<div class="countdown">
					<span id="clock"></span>
				</div>
					<script type="text/javascript">

						$('#clock').countdown('{{ $year }}/{{ $month }}/{{ $day }} {{$hour }}:{{ $minute }}:{{ $second }}')
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
								$(this).html('The Battle is over !')
										.parent().addClass('disabled').on('click', function(event){
											location.reload();
										});
						});
				</script>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
				<img src="/images/fleetleave.gif" class="img-responsive" style=" border-radius: 10px">
			</div>
			
			<div class="col-md-6">
				<img src="/images/fleetbattle.gif" class="img-responsive" style=" border-radius: 10px">
			</div>
		</div>
		<div class="row">
			<h1>Attack in Progress!</h1>
		</div>


	</div>

	@endsection