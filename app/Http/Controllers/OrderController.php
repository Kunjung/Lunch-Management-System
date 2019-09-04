<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
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

        return view('orders.index')->with('orders', $orders);

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
