<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $type = $user->type;
        $is_active = $user->is_active;

        // If not activated, don't show anything to user & logout user
        if ($is_active == false) {
            Auth::logout();
            Session::flash('danger', "Account Not activated yet. Please call admin to confirm.");
            return redirect('/login');
        }

        // If activated, check what type of user it is: admin, employee or kitchen
        // and depending on the user type, show the appropriate response
        if ($type == 'admin') {
            // return "Admin";
            // list of all active employees
            $employees = User::where('type', 'employee')->get();//where('is_active', 1)->get();
            
            // list of all kitchen_staffs
            $kitchen_staffs = User::where('type', 'kitchen')->where('is_active', true)->get();

            // List of all non-activated-users
            $not_activated_users = User::where('is_active', false)->get();

            return view('users.admin')->with('user', $user)->with('employees', $employees)->with('kitchen_staffs', $kitchen_staffs)->with('not_activated_users', $not_activated_users);
        }

        else if ($type == 'kitchen') {
            // return "kitchen";
            return view('users.kitchen')->with('user', $user);
        }

        else if ($type == 'employee') {
            // return "employee";
            // Show all the current orders at the Dashboard for the employee
            // The orders can have name, food name, category, day, takenStatus & completedStatus
            $day = date('Y-m-d');
    
            $orders = Order::where('user_id', $user->id)->where('day', $day)->get();
            $orders_info = [];

            foreach($orders as $order) {
                $info = [];
                $employee_name = User::find($order->user_id)->name;
                $food_name = Food::find($order->food_id)->name;
                $food_category = Food::find($order->food_id)->category;
                $day = $order->day;
                $is_taken = $order->is_taken;
                $is_completed = $order->is_completed;
                $date_time = $order->date_time;
                $time = explode(' ', $date_time)[1];

                array_push($info, $employee_name, $food_name, $food_category, $day, $is_taken, $is_completed, $time);

                array_push($orders_info, $info);
            }

    
            return view('users.employee')->with('user', $user)->with('orders_info', $orders_info);

        }

        

        else {
            return "Unknown Type of User";
        }

    }
}
