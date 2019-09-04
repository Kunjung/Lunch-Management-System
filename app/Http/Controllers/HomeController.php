<?php

namespace App\Http\Controllers;

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
        if ($is_active == 0) {
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

        else if ($type == 'employee') {
            return view('users.home')->with('user', $user);

        }

        else if ($type == 'kitchen') {
            return view('users.home')->with('user', $user);
        }

        else {
            return "Unknown Type of User";
        }

    }
}
