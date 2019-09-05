@extends('layouts.app')

@section('title', 'Making an Order')

@section('content')
		
	<h4>Day: {{ $day }} </h4> 
	{{-- Display all orders TODO - taken = false, completed = false --}}
	<h3>To Do List of orders</h3>
	
	@if(count($orders_todo_info) == 0)
		<p class="lead text-success">All orders completed.</p>
	@else
		
		<table class="table table-bordered text-danger bg-dark">
				<tr>
					<th> Made by Employee </th>
					<th> Food Name </th>
					<th> Food Category </th>
					<th> Day </th>
					<th> Is Taken? </th>
					<th> Is Completed? </th>
					<th> Ready to Take the Order </th>
				</tr>
			@foreach($orders_todo_info as $order_info)
				<tr>
					<td> {{ $order_info[0] }} </td>
					<td> {{ $order_info[1] }} </td>
					<td> {{ $order_info[2] }} </td>
					<td> {{ $order_info[3] }} </td>
					<td> <b>{{ $order_info[4] }}</b> </td>
					<td> <b>{{ $order_info[5] }}</b> </td>
					<td>
						{!! Form::open(['route' => ['takeorder.edit', $order_info[6] ], 'method' => 'GET']) !!}
							<button type="submit" class="btn btn-sm btn-warning">Ready to Take</button>
						{!! Form::close() !!}

					</td>					
				</tr>
			@endforeach				
		</table>
	@endif

	<br>
	{{-- Show all orders that are currently being procecssed. taken = true, completed = false --}}
	<h3>Orders Taken and waiting to be completed</h3>
	
	@if(count($orders_taken_info) == 0)
		<p class="lead text-danger">No orders taken today.</p>
	@else
		<table class="table table-bordered text-warning bg-dark">
				<tr>
					<th> Made by Employee </th>
					<th> Food Name </th>
					<th> Food Category </th>
					<th> Day </th>
					<th> Is Taken? </th>
					<th> Is Completed? </th>
					<th> Complete the Order </th>
				</tr>
			@foreach($orders_taken_info as $order_info)
				<tr>
					<td> {{ $order_info[0] }} </td>
					<td> {{ $order_info[1] }} </td>
					<td> {{ $order_info[2] }} </td>
					<td> {{ $order_info[3] }} </td>
					<td> <b>{{ $order_info[4] }}</b> </td>
					<td> <b>{{ $order_info[5] }}</b> </td>
					<td>
						{!! Form::open(['route' => ['takeorder.edit', $order_info[6] ], 'method' => 'GET']) !!}
							<button type="submit" class="btn btn-md btn-success">It's Done</button>
						{!! Form::close() !!}

					</td>					
				</tr>
			@endforeach				
		</table>
	@endif


	<br>
	{{-- Show all orders that have been completd. taken = true, completed = true --}}
	<h3>Orders Completed</h3>
	
	@if(count($orders_completed_info) == 0)
		<p class="lead text-danger">No orders completed today.</p>
	@else
		<table class="table table-bordered text-success bg-dark">
				<tr>
					<th> Made by Employee </th>
					<th> Food Name </th>
					<th> Food Category </th>
					<th> Day </th>
					<th> Is Taken? </th>
					<th> Is Completed? </th>
				</tr>
			@foreach($orders_completed_info as $order_info)
				<tr>
					<td> {{ $order_info[0] }} </td>
					<td> {{ $order_info[1] }} </td>
					<td> {{ $order_info[2] }} </td>
					<td> {{ $order_info[3] }} </td>
					<td> <b>{{ $order_info[4] }}</b> </td>
					<td> <b>{{ $order_info[5] }}</b> </td>					
				</tr>
			@endforeach				
		</table>
	@endif



@endsection