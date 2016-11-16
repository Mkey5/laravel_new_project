@extends('layouts.app')

@section('content')

<div class="container">
	@foreach ($allUsers as $user)
	    <p>This is user {{ $user->name }}</p>
	@endforeach

</div>


@endsection