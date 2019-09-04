<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //
    }

    
    public function store(Request $request)
    {
        //
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
