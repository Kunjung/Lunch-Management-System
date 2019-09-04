@extends('layouts.app')

@section('title', 'Menu of the Day')

@section('content')
		
	<h2>Menu of the Day</h2>
	<br>

	@if(count($foods) == 0)
		<p class="lead">Nothing in the menu today. {{ $day }}</p>
	@else
		{{-- Display all foods --}}
		<div class="row mt-3">

		@foreach($foods as $food)
		
				<div class="col-sm-3 border p-3 mb-2 bg-dark text-white">
				
					<h4> {{ $food->name }} </h4>
					<p> {{ $food->category }} </p>
					<p> Available Today {{ $food->is_active_today }} </p>

				</div>
			<hr>
			
		@endforeach
		</div>

	@endif

@endsection