@extends('layouts.main')

@section('title', 'Menu of the Day')

@section('content')

	<h2>History of Menus</h2>
		
	
	<h4>Choose Date to view menu of that day</h4>

		@foreach($days as $day)
			

			<div class="row justify-content-center mt-3">

				<div class="col-sm-3">
					<h3> {{ $day }} </h3>
				</div> 	

				<div class="col-sm-3">
					<a class="btn btn-success" href="{{ route('report.show', ['day' => $day]) }}">Show Menu</a>
				</div>

			</div>
		

		@endforeach

	
@endsection