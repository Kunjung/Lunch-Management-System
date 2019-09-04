
{{ Form::label('day', "Today's Date", ['class' => 'control-label']) }}
{{ Form::date('day', \Carbon\Carbon::now(), ['class' => 'form-control']) }}


<div class="row justify-content-center mt-4">
	<div class="col-sm-4">
		<a class="btn btn-block btn-secondary" href="{{ route('food.index') }}">Go Back</a>
	</div>

	<div class="col-sm-4">
		<button class="btn btn-block btn-success" type="submit">Save Today's Menu</button>
		<p class="danger"><small>Warning: This operation can only be done once a day.</small></p>
	</div>
</div>


