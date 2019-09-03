<?php

namespace App\Http\Controllers;

use App\Food;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        $active_foods = Food::where('is_active_today', 1)->get();

        return view('menus.index')->with('active_foods', $active_foods);
    }

    public function create()
    {
        $active_foods = Food::where('is_active_today', 1)->get();
        // The Current Date on which the Menu was created. Donot allow to change if the menu of the current date already exists in the database
        $day_of_today = date("Y-m-d"); 
        
        // for every active food, add it's id to the new menu
        foreach ($active_foods as $active_food) {
            $menu = new Menu;
            $menu->day = $day_of_today;
            $menu->food_id = $active_food->id;
            $menu->save();            
        }

        Session::flash('success', 'Menu of the Day Set Successfully');
        
        // Return a Redirect
        return redirect()->route('menu.index');

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        return "Showign it";
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
        //
    }
}
