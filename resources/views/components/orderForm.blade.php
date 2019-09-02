{{ Form::label('food_item', 'Food Name', ['class' => 'control-label']) }}
{{ Form::text('food_item', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Food Name'])}}


{{ Form::label('employee', 'Employee Name', ['class' => 'control-label']) }}
{{ Form::text('employee', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Employee Name'])}}


{{ Form::label('due_date', 'Date', ['class' => 'control-label']) }}
{{ Form::date('due_date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}

<div class="row justify-content-center mt-4">
	<div class="col-sm-4">
		<a class="btn btn-block btn-secondary" href="{{ route('order.index') }}">Go Back</a>
	</div>

	<div class="col-sm-4">
		<button class="btn btn-block btn-success" type="submit">Save Order</button>
	</div>
</div>


