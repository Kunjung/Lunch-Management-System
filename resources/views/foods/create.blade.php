@extends('layouts.main')

@section('title', 'Create Order')

@section('content')

	<div class="row">
		<div class="col-sm-12">
			<h1>Create Order</h1>
			
			{!! Form::open(['route' => 'order.store', 'method' => 'STORE']) !!}

			@component('components.orderForm')
			@endcomponent

			{!! Form::close() !!}
		</div>
	</div>

@endsection