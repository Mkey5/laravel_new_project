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
	        /*background: url('/images/battlestation.jpg') no-repeat scroll center center / cover;*/
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



		.planet{
			margin-top: 10px;
		}

	</style>

	<div class="container">
		Battle in Progress
	</div>

	@endsection