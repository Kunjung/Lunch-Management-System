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
        // Specifically for the Kitchen Staff
        // Normal Case: Called by Admin on the kitchen user $id to change the user - Kitchen Staff
        $user = Auth::user();
        // verify that it's from the admin first
        if ($user->type != 'admin') {
            return "Not Admin. You cannot edit this";
        }

        // confirmed that it is admin
        $kitchen_staff = User::find($id); // Gets the kitchen staff

        if (!$kitchen_staff || $kitchen_staff->type != 'kitchen') {
            return "Kitchen Staff with not present";
        }
        // confirmed admin is changing it as well as the id given belongs to a kitchen staff
        return view('users.editKitchenStaff')->with('kitchen_staff', $kitchen_staff);
    }

    
    public function update(Request $request, $id)
    {

        // Normal Case: Called by Admin on the user $id to set the user to activate the new user - employee/staff
        $user = Auth::user();
        if ($user->type != 'admin') {
            return "You cannot do that.";
        }
        
        // Confirmed that it's admin that is using update    
        $employee_or_kitchen = User::find($id);
        if (!$employee_or_kitchen) {
            return "User doesn't exist";
        }
        
        // ever condition satisfied, so just set the is_active field to true
        if ($employee_or_kitchen->type == 'employee') {
            // found out its an employee, so set active
            $employee_or_kitchen->is_active = true;
            $employee_or_kitchen->save();        
            Session::flash('success', 'Employee Activated successfully');
        
        }
        if ($employee_or_kitchen->type == 'kitchen') {
            // Second Case: Called by Admin on the Kitchen user to edit the kitchen account
            // Condition: user->type == 'kitchen'
            $this->validate($request, [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|email',
                'password' => 'required|string|max:255|min:3'
            ]);
            $employee_or_kitchen->name = $request->name;
            $employee_or_kitchen->email = $request->email;
            $hashed_password = Hash::make($request->password);
            $employee_or_kitchen->password = $hashed_password;

            $employee_or_kitchen->save();

            Session::flash('success', 'Kitchen Staff Activated successfully');
        }
        return redirect()->route('home');

        
    }

    public function destroy($id)
    {
        //
    }
}
