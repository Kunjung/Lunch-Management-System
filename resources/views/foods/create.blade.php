@extends('layouts.main')

@section('title', 'New Food')

@section('content')

	<div class="row">
		<div class="col-sm-12">
			<h1>Add New Food Item</h1>
			
			{!! Form::open(['route' => 'food.store', 'method' => 'STORE']) !!}

			@component('components.foodForm')
			@endcomponent

			{!! Form::close() !!}
		</div>
	</div>

@endsection