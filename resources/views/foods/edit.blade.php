@extends('layouts.main')

@section('title', 'Edit Order')

@section('content')

	<div class="row">
		<div class="col-sm-12">
			<h1>Edit Order</h1>
			
			{!! Form::model($order, ['route' => ['order.update', $order->id], 'method' => 'PUT']) !!}

			@component('components.orderForm')
			@endcomponent

			{!! Form::close() !!}
		</div>
	</div>

@endsection