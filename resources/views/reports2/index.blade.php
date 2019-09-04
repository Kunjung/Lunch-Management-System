@extends('layouts.app')

@section('title', 'Menu of the Day')

@section('content')

	<h2 class="p-3 mb-2 bg-info text-white">Report #2: History of Orders Made By Employees</h2>
		
	<ol>

		@foreach($employees as $employee)

			<li>
			<div class="p-3 mb-2 bg-gradient-light text-dark">
				<h3>Name: {{ $employee->name }}</h3>
				<a class="btn btn-primary" href="{{ route('report2.show', ['user_id' => $employee->id]) }}">
					Show {{ $employee->name }}'s Order History
				</a>
				<p>Type: {{ $employee->type }}</p>
			</div>
			</li>
			
		@endforeach
		

	</ol>
	
@endsection