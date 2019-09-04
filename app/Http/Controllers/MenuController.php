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
        // $active_foods = Food::where('is_active_today', 1)->get();

        // return view('menus.index')->with('active_foods', $active_foods);

        $day = date('Y-m-d');
        $menu = Menu::where('day', $day)->get();
        
        $foods = [];
        foreach($menu as $item) {
            $food_id = $item->food_id;
            $food = Food::find($food_id);
            if ($food) {
                array_push($foods, $food);
            }
        }
        
        // return $foods;
        return view('menus.index')->with('foods', $foods)->with('day', $day);
    }



    public function create()
    {
        $active_foods = Food::where('is_active_today', 1)->get();

        return view('menus.create')->with('active_foods', $active_foods);

    }



    public function store(Request $request)
    {
        // Validate the Date
        $this->validate($request, [
            'day' => 'required|date',
        ]);

        $active_foods = Food::where('is_active_today', 1)->get();
        // The Current Date on which the Menu was created. Donot allow to change if the menu of the current date already exists in the database
        $menu = Menu::where('day', $request->day)->get();

        if ($menu->count() > 0) {
            // Meaning there already is a menu with today's day. Today's menu has already been set.
            // Refuse setting new menu.
            Session::flash('danger', "Menu has already been set for today. Can't make new menu");
            return redirect()->route('menu.index');
        } 

        //$day_of_today = date("Y-m-d");
        
        // for every active food, add it's id to the new menu
        foreach ($active_foods as $active_food) {
            $menu = new Menu;
            $menu->day = $request->day;
            $menu->food_id = $active_food->id;
            $menu->save();            
        }

        Session::flash('success', 'Menu of the Day Set Successfully');
        
        // Return a Redirect
        return redirect()->route('menu.index');
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
