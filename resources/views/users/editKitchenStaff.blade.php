@extends('layouts.app')

@section('title', 'Edit Kitchen Staff')

@section('content')

	<div class="row">
		<div class="col-sm-12">
			<h1>Edit Kitchen Staff</h1>
			
			{!! Form::model($kitchen_staff, ['route' => ['user.update', $kitchen_staff->id], 'method' => 'PUT']) !!}

			@component('components.kitchenStaffForm')
			@endcomponent

			{!! Form::close() !!}

			{!! Form::open(['route' => ['user.destroy', $kitchen_staff->id], 'method' => 'DELETE']) !!}
                        <button type="submit" class="btn btn-sm btn-danger"><small>Delete</small></button>
            {!! Form::close() !!}
		</div>
	</div>

@endsection