Hello Mr./Ms. <strong>{{ $employee_name }}</strong>,
<br>
<p><span>    </span> {{ $body }} </p>

<p>The order was made by Mr./Mrs. {{ $employee_name }} for <strong>Food Item: {{ $food_name }}</strong></p>

<br>

<p>Order completed on <strong>day {{ $day }} </strong> at <strong>time {{ $current_time }} </strong></p>


@if($is_completed == 1)

	<p>The order has been completed.</p>
@else
	<p>order not completed. System error. Please contact developer</p>

@endif
