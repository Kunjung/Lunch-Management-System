@extends('layouts.app')

@section('title', 'Making an Order')

@section('content')
		
	<h2>To Do list of orders for day {{ $day }} </h2>
	<br>

	@if(count($orders_todo_info) == 0)
		<p class="lead text-success">All orders completed.</p>
	@else
		{{-- Display all orders TODO - taken = false, completed = false --}}

		<div class="row">

			<table class="table table-bordered">
					<tr>
						<th> Made by Employee </th>
						<th> Food Name </th>
						<th> Food Category </th>
						<th> Day </th>
						<th> Is Taken? </th>
						<th> Is Completed? </th>
					</tr>

				@foreach($orders_todo_info as $order_info)
					<tr>
						
						<td> {{ $order_info[0] }} </td>
						<td> {{ $order_info[1] }} </td>
						<td> {{ $order_info[2] }} </td>
						<td> {{ $order_info[3] }} </td>
						<td> {{ $order_info[4] }} </td>
						<td> {{ $order_info[5] }} </td>
						
					</tr>
				@endforeach
				
			</table>

		</div>

	@endif

@endsection