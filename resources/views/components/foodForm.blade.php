{{ Form::label('name', 'Food Name', ['class' => 'control-label']) }}
{{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Food Name'])}}


{{ Form::label('category', 'Category Name', ['class' => 'control-label']) }}
{{ Form::text('category', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Category Name'])}}


<div class="row justify-content-center mt-4">
	<div class="col-sm-4">
		<a class="btn btn-block btn-secondary" href="{{ route('food.index') }}">Go Back</a>
	</div>

	<div class="col-sm-4">
		<button class="btn btn-block btn-success" type="submit">Save Food Item</button>
	</div>
</div>


