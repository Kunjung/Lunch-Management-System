@extends('layouts.main')

@section('title', 'Menu of the Day')

@section('content')

	<h2>History of Menus</h2>
		
	
	<h4>Choose Date to view menu of that day</h4>
	<ul>

		@foreach($days as $day)

			<li>
				<a class="btn btn-secondary" href="{{ route('report.show', ['day' => $day]) }}">
					Menu for the day: {{ $day }}
				</a>
			</li>
			<br>

		@endforeach
		

	</ul>
	
@endsection