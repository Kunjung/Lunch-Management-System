<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NotificationEmailController extends Controller
{
    //
    public function sendmail($order_id) {
    	

    	$user = Auth::user();
    	if ($user->type != 'kitchen') {
    		return "Only Kitchen Staff can send email notification";
    	}
    	$order = Order::find($order_id);
    	if (!$order) {
    		return "Order Not here";
    	}

    	if (!$order->is_taken) {
    		return "Order Not taken";
    	}

    	if (!$order->is_completed) {
    		return "Order Not completed";
    	}
        
        $employee = User::find($order->user_id);
        $food = Food::find($order->food_id);
        
        $day = $order->day;
        $is_completed = $order->is_completed;

    	$to_name = $employee->name;
		$to_email = $employee->email;

		$current_time = date("H:i:s");
		
		$data = array(
					'name'=> $to_name, 
					'body' => "Order is Ready. Come & get it.",
					'employee_name' => $employee->name,
					'food_name' => $food->name,
					'day' => $day,
					'current_time' => $current_time,
					'is_completed' => $is_completed,
				);
		
		Mail::send('notificationEmail.mail', $data, function($message) use ($to_name, $to_email) {
		
			$message->to($to_email, $to_name)
					->subject("Lunch is Ready");
			$message->from("no-reply@yummy-lunch.com", "Yummy Lunch");

		});

		Session::flash('success', "Email Sent Successfully");
		return redirect()->route('home');

    }

}
