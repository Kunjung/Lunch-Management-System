<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $day = date('Y-m-d');
        $user = Auth::user();

        if ($user->type !== 'employee') {
            return "Not allowed for non-employee";
        }

        $orders = Order::where('user_id', $user->id)->where('day', $day)->get();

        $orders_info = [];

        foreach($orders as $order) {
            $info = [];
            $employee_name = User::find($order->user_id)->name;
            $food_name = Food::find($order->food_id)->name;
            $is_taken = $order->is_taken;
            $day = $order->day;
            $is_completed = $order->is_completed;

            array_push($info, $employee_name, $food_name, $day, $is_taken, $is_completed);

            array_push($orders_info, $info);
        }

        return view('orders.index')->with('orders_info', $orders_info);

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
        // Validate the data
        // return $request->time;
        $this->validate($request, [
            'time' => 'required|date',
            'food_id' => 'required',
        ]);
        

        $food_id = $request->food_id;
        
        $food = Food::find($food_id);
        if (!$food) {
            Session::flash('danger', 'Food Item Not in Kitchen');
            return redirect()->route('menu.index');
        }
        $user = Auth::user();
        //Check to make sure the user is an employee
        if ($user->type !== 'employee') {
            Session::flash('danger', 'Only Employees can make an order');
            return redirect()->route('menu.index');
        }
        // Certain that food is available and user is employee
        $day = date('Y-m-d');

        $previous_orders = Order::where('day', $day)->where('user_id', $user->id)->get();

        foreach($previous_orders as $previous_order) {
            if ($previous_order->food_id == $food->id) {
                Session::flash('danger', "Food already ordered! Can't order again");
                return redirect()->route('menu.index');
            }            
        }


        // All conflicts handled. Now, Make a New order
        $order = new Order;
        $order->food_id = $food->id;
        $order->day = $day;
        $order->user_id = $user->id;

        $order->date_time = $request->time;

        $order->save();
        Session::flash('success', 'Order Made');
        return redirect()->route('menu.index');

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
        $food_id = $id;
        $food = Food::find($food_id);
        if (!$food) {
            Session::flash('danger', 'Food Item Not in Kitchen');
            return redirect()->route('menu.index');
        }
        $user = Auth::user();
        //Check to make sure the user is an employee
        if ($user->type !== 'employee') {
            Session::flash('danger', 'Only Employees can make an order');
            return redirect()->route('menu.index');
        }
        // Certain that food is available and user is employee
        $day = date('Y-m-d');

        $previous_orders = Order::where('day', $day)->where('user_id', $user->id)->get();

        foreach($previous_orders as $previous_order) {
            if ($previous_order->food_id == $food->id) {
                Session::flash('danger', "Food already ordered! Can't order again");
                return redirect()->route('menu.index');
            }            
        }


        // All conflicts handled. Now, Make a New order
        $order = new Order;
        $order->food_id = $food->id;
        $order->day = $day;
        $order->user_id = $user->id;

        $order->save();
        Session::flash('success', 'Order Made');
        return redirect()->route('menu.index');
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
