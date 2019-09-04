{{ Form::label('name', 'Name', ['class' => 'control-label']) }}
{{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Name'])}}


{{ Form::label('email', 'Email', ['class' => 'control-label']) }}
{{ Form::text('email', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Email'])}}


{{ Form::label('password', 'Password', ['class' => 'control-label']) }}
{{ Form::text('password', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'password'])}}


<div class="row justify-content-center mt-4">
	<div class="col-sm-4">
		<a class="btn btn-block btn-secondary" href="{{ route('home') }}">Go Back</a>
	</div>

	<div class="col-sm-4">
		<button class="btn btn-block btn-success" type="submit">Save Kitchen Staff</button>
	</div>
</div>


