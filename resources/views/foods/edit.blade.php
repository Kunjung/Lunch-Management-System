@extends('layouts.app')

@section('title', 'Edit Food')

@section('content')

	<div class="row">
		<div class="col-sm-12">
			<h1>Edit Order</h1>
			
			{!! Form::model($food, ['route' => ['food.update', $food->id], 'method' => 'PUT']) !!}

			@component('components.foodForm')
			@endcomponent

			{!! Form::close() !!}
		</div>
	</div>

@endsection