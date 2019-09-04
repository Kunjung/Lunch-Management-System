@extends('layouts.app')

@section('title', 'New Kitchen Staff')

@section('content')

	<div class="row">
		<div class="col-sm-12">
			<h1>Add New Kitchen Staff</h1>
			
			{!! Form::open(['route' => 'user.store', 'method' => 'STORE']) !!}

			@component('components.kitchenStaffForm')
			@endcomponent

			{!! Form::close() !!}
		</div>
	</div>

@endsection