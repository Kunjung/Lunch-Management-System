<?php

namespace App\Http\Controllers;

use App\Food;
use App\Menu;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        //Show the History of Menu for each day
        $menus = Menu::orderBy('day', 'asc')->get();
        
        $days = [];
        foreach($menus as $menu) {
            foreach(explode(',', $menu->day) as $day) {
                $days[] = trim($day);
            }
        }
        $days = array_unique($days);

        return view('reports.index')->with('days', $days);//with('menus', $menus)->with('days', $days)->with('active_foods', $active_foods);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($day_string)
    {
        $day = date($day_string);
        $menu = Menu::where('day', $day)->get();

        $foods_in_menu = [];
        foreach($menu as $item) {
            $food_id = $item->food_id;
            $food = Food::find($food_id);
            array_push($foods_in_menu, $food);
        }
        
        return view('reports.show')->with('foods_in_menu', $foods_in_menu)->with('day', $day);
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
