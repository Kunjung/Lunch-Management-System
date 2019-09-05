
{{ Form::label('day', "Time for lunch", ['class' => 'control-label']) }}
{{ Form::date('day', \Carbon\Carbon::now(), ['class' => 'form-control']) }}


<button type="submit" class="btn btn-sm btn-danger">Order Now</button>

