<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TakeOrderController extends Controller
{
    public function index()
    {
        $day = date('Y-m-d');
        $user = Auth::user();

        if ($user->type !== 'kitchen') {
            return "Not allowed for non-kitchen staff";
        }

        // 1st Info is Orders Todo - Red
        $orders_todo = Order::where('is_taken', false)->where('is_completed', false)->where('day', $day)->get();

        $orders_todo_info = [];

        foreach($orders_todo as $order) {
            $info = [];
            $employee_name = User::find($order->user_id)->name;
            $food_name = Food::find($order->food_id)->name;
            $food_category = Food::find($order->food_id)->category;
            $is_taken = $order->is_taken;
            $day = $order->day;
            $is_completed = $order->is_completed;

            $order_id = $order->id;

            array_push($info, $employee_name, $food_name, $food_category, $day, $is_taken, $is_completed, $order_id);

            array_push($orders_todo_info, $info);
        }

        // 2nd Info is Orders taken and not completed - Yellow
        $orders_taken = Order::where('is_taken', true)->where('is_completed', false)->where('day', $day)->get();

        $orders_taken_info = [];
        
        foreach($orders_taken as $order) {
            $info = [];
            $employee_name = User::find($order->user_id)->name;
            $food_name = Food::find($order->food_id)->name;
            $food_category = Food::find($order->food_id)->category;
            $is_taken = $order->is_taken;
            $day = $order->day;
            $is_completed = $order->is_completed;

            $order_id = $order->id;

            array_push($info, $employee_name, $food_name, $food_category, $day, $is_taken, $is_completed, $order_id);

            array_push($orders_taken_info, $info);
        }

        // 3rd Info is Orders taken and Completed - Green
        $orders_completed = Order::where('is_taken', true)->where('is_completed', true)->where('day', $day)->get();

        $orders_completed_info = [];
        
        foreach($orders_completed as $order) {
            $info = [];
            $employee_name = User::find($order->user_id)->name;
            $food_name = Food::find($order->food_id)->name;
            $food_category = Food::find($order->food_id)->category;
            $is_taken = $order->is_taken;
            $day = $order->day;
            $is_completed = $order->is_completed;

            array_push($info, $employee_name, $food_name, $food_category, $day, $is_taken, $is_completed);

            array_push($orders_completed_info, $info);
        }

        return view('takeorders.index')->with('orders_todo_info', $orders_todo_info)
                                       ->with('orders_taken_info', $orders_taken_info)
                                       ->with('orders_completed_info', $orders_completed_info)
                                       ->with('day', $day);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_id = $id;
        $order = Order::find($order_id);
        if (!$order) {
            Session::flash('danger', 'Order Not here');
            return redirect()->route('takeorder.index');
        }
        $user = Auth::user();
        //Check to make sure the user is an employee
        if ($user->type !== 'kitchen') {
            Session::flash('danger', 'Only Kitchen Staff can take an order');
            return redirect()->route('takeorder.index');
        }

        // Condition that the order has been taken, and the kitchen staff is calling the edit function again.
        // Must mean that the order has been completed by now.
        // Future problems can be when there are many kitchen staff accounts and they might end up calling the same // order twice in the Take Order and that would make a bad behaviour that the order is now active.
        if ($order->is_taken == true) {

            $order->is_completed = true;
            $order->save();

            Session::flash('success', 'Order has been completed. Message Sent.');
            return redirect()->route('sendmail', ['order_id' => $order_id]);

            // Session::flash('success', 'Order has been completed. Message has already been sent to employee that their order is ready');
            // return redirect()->route('takeorder.index');
        }


        $order->is_taken = true;
        $order->save();

        Session::flash('success', 'Order Has been taken. Chef time');
        return redirect()->route('takeorder.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
