<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Report2Controller extends Controller
{
    // Reports can only be seen by logged in users
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check to see that admin is making the request
        $user = Auth::user();
        if ($user->type != 'admin') {

            return "You cannot do that";

        }
        //Show the History of orders for each employee
        $employees = User::where('type', 'employee')->where('is_active', true)->get();

        return view('reports2.index')->with('employees', $employees);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($user_id)
    {
        // Check to see that admin is making the request
        $user = Auth::user();
        if ($user->type != 'admin') {
            return "You cannot do that";
        }
        $employee = User::find($user_id);
        if (!$employee) {
            return "Employee doesn't exist.";
        }

        // Get all orders made by this particular employee
        $orders = Order::where('user_id', $employee->id)->orderBy('day', 'asc')->get();

        $orders_info = [];
        foreach($orders as $order) {
            
            $info = [];

            $food_id = $order->food_id;
            $food = Food::find($food_id);
            $food_name = $food->name;
            $food_category = $food->category;

            $day = $order->day;
            $is_taken = $order->is_taken;
            $is_completed = $order->is_completed;

            $date_time = $order->date_time;
            $time = explode(' ', $date_time)[1];

            array_push($info, $day, $food_name, $food_category, $is_taken, $is_completed, $time);

            array_push($orders_info, $info);
        }
        
        return view('reports2.show')->with('orders_info', $orders_info)->with('employee', $employee);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {


    }
}
