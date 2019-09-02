<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::orderBy('category', 'asc')->paginate(30);

        $categories = [];
        foreach($foods as $food) {
            foreach(explode(',', $food->category) as $category) {
                $categories[] = trim($category);
            }
        }
        $categories = array_unique($categories);

        return view('foods.index')->with('foods', $foods)->with('categories', $categories);
    }

    public function create()
    {
        return view('foods.create');
    }

    public function store(Request $request)
    {
        // return $request;
        // Validate the data
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'category' => 'required|string|max:255|min:3',
        ]);
        // Create a new food
        $food = new Food;

        // Assign the food data from our request
        $food->name = $request->name;
        $food->category = $request->category;
        
        // Save the food
        $food->save();
        
        // Flash session message with Success
        Session::flash('success', 'Created food Successfully');
        
        // Return a Redirect
        return redirect()->route('food.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $food = Food::find($id);
        $food->dueDateFormatting = false;

        return view('foods.edit')->withfood($food);
    }

    public function update(Request $request, $id)
    {
        // Validate the data
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'category' => 'required|string|max:255|min:3',
        ]);
        // Create a new food
        $food = Food::find($id);

        // Assign the food data from our request
        $food->name = $request->name;
        $food->category = $request->category;
        
        // Save the food
        $food->save();
        
        // Flash session message with Success
        Session::flash('success', 'Updated food Successfully');
        
        // Return a Redirect
        return redirect()->route('food.index');
    }

    public function destroy($id)
    {
        $food = Food::find($id);

        $food->delete();

        Session::flash('success', 'Deleted food Successfully');

        return redirect()->route('food.index');
    }
}
