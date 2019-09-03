@extends('layouts.main')

@section('title', 'Menu of the Day')

@section('content')


	@if($active_foods->count() == 0)
		<p class="lead">No food item added to menu.</p>
	@else
		<h2>Menu of the Day</h2>
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

		<div class="row justify-content-center mt-4">
			<div class="col-sm-3">
				<a class="btn btn-block btn-secondary" href="{{ route('food.index') }}">Go Back</a>
			</div>
				
			<div class="col-sm-3">
				<a class="btn btn-block btn-success" href="{{ route('menu.create') }}">Set as Menu of the Day</a>
				<p class="danger"><small>Warning: This operation can only be done once a day.</small></p>
			</div>

		</div>


	@endif

@endsection