@extends('layouts.main')

@section('title', 'Food Menu')

@section('content')


	<div class="row justify-content-center mt-3">
		<div class="col-sm-3">
			<a class="btn btn-success" href="{{ route('food.create') }}">Add New Food</a>
		</div> 

		<div class="col-sm-3">
			<a class="btn btn-primary" href="{{ route('menu.index') }}">Set Menu of the Day</a>
		</div> 	
	</div>

	@if($foods->count() == 0)
		<p class="lead">No food item added to menu.</p>
	@else

		{{-- Display All Categories --}}
		<h2>Food Categories</h2>
		<div class="row justify-content-center mt-3">
		
		@foreach($categories as $category)
				<div class="col-sm-4 border">
					<h4 font-color="red"> {{ $category }} </h4>
				</div>
		@endforeach
		</div>

		<br>
		<h2>All Food Items</h2>
		{{-- Display all foods --}}
		<div class="row justify-content-center mt-3">

		@foreach($foods as $food)

				<div class="col-sm-3 border">
				
					<h4> {{ $food->name }} </h4>
					<p> {{ $food->category }} </p>
					<p> Available Today {{ $food->is_active_today }} </p>

					{{-- <a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}

					{!! Form::open(['route' => ['food.destroy', $food->id], 'method' => 'DELETE']) !!}
						<button type="submit" class="btn btn-sm btn-danger"><small>Delete</small></button>
					{!! Form::close() !!}

				</div>

		@endforeach
		</div>

		<br>
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


	@endif

		

	<div class="row justify-content-center">
		<div class="col-sm-6 text-center">
			{{ $foods->links() }}
		</div>
	</div>

@endsection