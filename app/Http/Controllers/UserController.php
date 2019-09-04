<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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


    public function index()
    {
        //
    }

    
    public function create()
    {
        return view('users.create');
    }

    
    public function store(Request $request)
    {
        // adding new user - Currently the expected one is a kitchen staff
        // first is error checking.
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email',
            'password' => 'required|string|max:255|min:3'
        ]);

        // Check to see that admin is making the request
        $user = Auth::user();
        if ($user->type != 'admin') {

            return "You cannot do that";

        }

        if ($user->type == 'admin') {

            // Check if email already exists. If it does, then flash error that email needs to be different
            $email = $request->email;
            $previous_users_with_same_email = User::where('email', $email)->get();

            if ($previous_users_with_same_email->count() > 0) {
                // Means the email is not unique
                // time to flash error message
                Session::flash('danger', 'User with given email already exists');
                return redirect()->route('user.create');

            }


            $kitchen_staff = new User;

            
            $kitchen_staff->name = $request->name;
            $kitchen_staff->email = $request->email;

            // Need to add hashed password only.
            $hashed_password = Hash::make($request->password);
            $kitchen_staff->password = $hashed_password;

            // User is of Kitchen Staff Type
            $kitchen_staff->type = 'kitchen';
            $kitchen_staff->is_active = true;
            
            $kitchen_staff->save();
            
            Session::flash('success', 'New Kitchen Staff Added Successfully');
            return redirect()->route('home');

        }

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {

        // Normal Case: Called by Admin on the user $id to set the user to activate the new user - employee/staff
        $user = Auth::user();
        if ($user->type == 'admin') {
            $not_activated_user = User::find($id);
            if (!$not_activated_user) {
                return "User doesn't exist";
            }
            
            // ever condition satisfied, so just set the is_active field to true
            $not_activated_user->is_active = true;
            $not_activated_user->save();
            if ($not_activated_user->type == 'employee') {
                Session::flash('success', 'Employee Activated successfully');
            }
            if ($not_activated_user->type == 'kitchen') {
               Session::flash('success', 'Kitchen Staff Activated successfully');
            }
            return redirect()->route('home');

        } else {
            return "You cannot do that.";
        }
    }

    public function destroy($id)
    {
        //
    }
}
