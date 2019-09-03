@extends('layouts.main')

@section('title', 'Menu of the Day')

@section('content')


	<h2>Menu of the Day {{ $day }} </h2>
		
		<div class="row justify-content-center mt-3">

		@foreach($foods_in_menu as $food)

				<div class="col-sm-3 border">
				
					<h4> {{ $food->name }} </h4>
					<p> {{ $food->category }} </p>

				</div>
			<hr>

		@endforeach
		
		</div>



@endsection