@extends('layouts.app')

@section('title', 'Menu of the Day')

@section('content')


	<h2 class="p-3 mb-2 bg-info text-white">Report #1: Menu of the Day {{ $day }} </h2>
		
	<div class="p-3 mb-2 bg-dark text-white">

		<ol>
		@foreach($foods_in_menu as $food)
			<li>
				
				<h4> {{ $food->name }} </h4>
				<p> {{ $food->category }} </p>

				
			</li>
		@endforeach
		</ol>
	</div>



@endsection