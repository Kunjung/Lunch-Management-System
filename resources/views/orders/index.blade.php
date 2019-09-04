@extends('layouts.app')

@section('title', 'Making an Order')

@section('content')
		
	<h2>Orders you've made so far for today</h2>
	<br>

	@if($orders->count() == 0)
		<p class="lead">Nothing ordered today.</p>
	@else
		{{-- Display all foods --}}
		<div class="row mt-3">

		@foreach($orders as $order)
		
				<div class="col-sm-3 border p-3 mb-2 bg-dark text-white">
				
					<h4> {{ $order->name }} </h4>
					<p> Employee {{ $order->user_id }} </p>
					<p> Food {{ $order->food_id }} </p>
					<p> Taken? {{ $order->is_taken }} </p>
					<p> Completed? {{ $order->is_completed }} </p>

				</div>
			<hr>
			
		@endforeach
		</div>

	@endif

@endsection