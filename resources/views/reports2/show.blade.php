@extends('layouts.app')

@section('title', 'Menu of the Day')

@section('content')


	<h2 class="p-3 mb-2 bg-info text-white">Report #2: Order History of Employee "{{ $employee->name }}" </h2>
		
	<div class="row">

	<table class="table table-bordered">
			<tr>
				<th> Day </th>
				<th> Food Name </th>
				<th>Food Category </th>
				<th>Is Taken? </th>
				<th>Is Completed? </th>
			</tr>

		@foreach($orders_info as $order_info)
			<tr>
				
				<td> {{ $order_info[0] }} </td>
				<td> {{ $order_info[1] }} </td>
				<td> {{ $order_info[2] }} </td>
				<td> {{ $order_info[3] }} </td>
				<td> {{ $order_info[4] }} </td>
				
			</tr>
		@endforeach
		
	</table>
	</div>



@endsection