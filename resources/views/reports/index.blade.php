@extends('layouts.app')

@section('title', 'Menu of the Day')

@section('content')

	<h2 class="p-3 mb-2 bg-info text-white">Report #1: History of Menus</h2>
		
	<ol>

		@foreach($days as $day)

			<li>
			<div class="p-3 mb-2 bg-gradient-light text-dark">
				{{ $day }}
				<a class="btn btn-primary" href="{{ route('report.show', ['day' => $day]) }}">
					Show {{ $day }}
				</a>
			</div>
			</li>
			
		@endforeach
		

	</ol>
	
@endsection