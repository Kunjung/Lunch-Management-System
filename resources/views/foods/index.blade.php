@extends('layouts.app')

@section('title', 'Food Menu')

@section('content')


	<div class="row justify-content-center mt-3 p-3 border border-success rounded">
		<div class="col-sm-6">
			<h2>The Kitchen</h2>
		</div>
		<div class="col-sm-3">
			<a class="btn btn-success" href="{{ route('food.create') }}">Add New Food</a>
		</div>

		<div class="col-sm-3">
			<a class="btn btn-primary" href="{{ route('menu.create') }}">Set Today's Menu</a>
		</div>
	</div>

	<br>

	@if($foods->count() == 0)
		<p class="lead">No food item added to menu.</p>
	@else

		{{-- Display All Categories --}}
		<h2>Current Food Categories</h2>
		<div class="row justify-content-center mt-3">
		
		@foreach($categories as $category)
				<div class="col-sm-2 border p-2">
					<h4 font-color="red"> {{ $category }} </h4>
				</div>
		@endforeach
		</div>

		<br>
		<h2>All Current Food Items</h2>
		{{-- Display all foods --}}
		<div class="row justify-content-center mt-3">

		@foreach($foods as $food)

				<div class="col-sm-3 border p-4">
				
					{!! Form::open(['route' => ['food.edit', $food->id], 'method' => 'GET']) !!}
						<button type="submit" class="btn btn-sm btn-success">Toggle Availability</button>
					{!! Form::close() !!}

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


	@endif

		

	<div class="row justify-content-center">
		<div class="col-sm-6 text-center">
			{{ $foods->links() }}
		</div>
	</div>

@endsection