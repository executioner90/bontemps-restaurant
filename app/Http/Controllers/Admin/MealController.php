<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealStoreRequest;
use App\Models\Meal;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::all();

        return view('admin.meals.index', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.meals.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealStoreRequest $request)
    {
        $image = $request->file('image') ? $request->file('image')->store('public/meals') : null;

        $meal = Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ]);

        // add products to created meal
        if ($request->has('products')) {
            $meal->products()->attach($request->products);
        }

        return to_route('admin.meals.index')->with('success', 'Meal created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        $products = Product::all();

        return view('admin.meals.edit', compact(['meal', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MealStoreRequest $request, Meal $meal)
    {
        $image = $meal->image;
        // check if image input has file
        if ($request->hasFile('image')) {
            // delete old image
            Storage::delete($meal->image);
            // save uploaded image
            $image = $request->file('image') ? $request->file('image')->store('public/meals') : null;
        }

        $meal->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ]);

        // edit products of current meal
        if ($request->has('products')) {
            $meal->products()->sync($request->products);
        }

        //redirect to index page
        return to_route('admin.meals.index')->with('success', 'Meal updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        // first delete image file
        if ($meal->image) {
            Storage::delete($meal->image);
        }

        // now delete menu
        $meal->delete();

        //redirect to index page
        return to_route('admin.meals.index')->with('success', 'Meal deleted successfully');
    }
}
