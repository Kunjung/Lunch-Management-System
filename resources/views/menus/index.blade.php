@extends('layouts.app')

@section('title', 'Menu of the Day')

@section('content')


	<div class="row justify-content-center mt-3">
		<div class="col-sm-3">
			<a class="btn btn-success" href="{{ route('food.index') }}">Go Back to Food</a>
		</div>

		<div class="col-sm-3">
			<a class="btn btn-primary" href="{{ route('menu.create') }}">Set Today's Menu</a>
		</div> 	
	</div>


	@if($active_foods->count() == 0)
		<p class="lead">No food item added to menu.</p>
	@else
		<h2>Possible Menu of the Day</h2>
		{{-- Display all foods --}}
		<div class="row justify-content-center mt-3">

		@foreach($active_foods as $active_food)

				<div class="col-sm-3 border">
				
					<h4> {{ $active_food->name }} </h4>
					<p> {{ $active_food->category }} </p>
					<p> Available Today {{ $active_food->is_active_today }} </p>

				</div>
			<hr>

		@endforeach
		</div>

	@endif

@endsection