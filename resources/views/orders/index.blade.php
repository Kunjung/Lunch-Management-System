@extends('layouts.app')

@section('title', 'Making an Order')

@section('content')
		
	<h2>Orders you've made so far for today</h2>
	<br>

	@if(count($orders_info) == 0)
		<p class="lead">Nothing ordered today.</p>
	@else
		{{-- Display all foods --}}
		<div class="row mt-3">

		@foreach($orders_info as $order_info)
		
				<div class="col-sm-3 border p-3 mb-2 bg-dark text-white">

					<p>By: {{ $order_info[0] }} </p>
                    <p>Food: {{ $order_info[1] }} </p>
                    <p>Day: {{ $order_info[2] }} </p>
                    <p>Taken?: {{ $order_info[3] }} </p>
                    <p>Completed: {{ $order_info[4] }} </p>

				</div>
			<hr>
			
		@endforeach
		</div>

	@endif

@endsection