@extends('layouts.main')

@section('title', 'Food Name')

@section('content')


	<div class="row justify-content-center mt-3">
		<div class="col-sm-4">
			<a class="btn btn-success" href="{{ route('food.create') }}">Create Order</a>
		</div>  	
	</div>

	@if($orders->count() == 0)
		<p class="lead">No orders made yet.</p>
	@else
		@foreach($orders as $order)

			<div class="row">
				<div class="col-sm-12">
				
					<h3>
						{{ $order->food_item }}
						<small>{{ $order->created_at }}</small>
					</h3>
					<h5>For <small>{{ $order->employee }}</small></h5>
					<h5>Date <small>{{ $order->due_date }}</small></h5>
					

					{!! Form::open(['route' => ['order.destroy', $order->id], 'method' => 'DELETE']) !!}
						<a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
						<button type="submit" class="btn btn-sm btn-danger">Delete</button>
					{!! Form::close() !!}

				</div>
			</div>
			<hr>

		@endforeach
	@endif

		

	<div class="row justify-content-center">
		<div class="col-sm-6 text-center">
			{{ $orders->links() }}
		</div>
	</div>

@endsection