@extends('layouts.main')

@section('title', 'Food Menu')

@section('content')


	<div class="row justify-content-center mt-3">
		<div class="col-sm-4">
			<a class="btn btn-success" href="{{ route('food.create') }}">Add New Food</a>
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

				<div class="col-sm-4 border">
				
					<h4> {{ $food->name }} </h4>
					<p> {{ $food->category }} </p>
					
					{!! Form::open(['route' => ['food.destroy', $food->id], 'method' => 'DELETE']) !!}
						<a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-primary">Edit</a>
						<button type="submit" class="btn btn-sm btn-danger">Delete</button>
					{!! Form::close() !!}

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