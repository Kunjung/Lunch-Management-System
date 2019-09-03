@extends('layouts.main')

@section('title', 'Confirm Menu')

@section('content')

	
	<h2>Final Menu of the Day</h2>
	<ul>
		@foreach($active_foods as $active_food)

			<li> <span class="text-success">{{ $active_food->name }} </span> <span class="text-danger">[ {{ $active_food->category }} ] </span></li>

		@endforeach
	</ul>

	<div class="row">
		<div class="col-sm-12">
			<h2>Confirm by Setting Menu of the Day</h2>
			
			{!! Form::open(['route' => 'menu.store', 'method' => 'POST']) !!}

			@component('components.menuForm')
			@endcomponent

			{!! Form::close() !!}
		</div>
	</div>

@endsection