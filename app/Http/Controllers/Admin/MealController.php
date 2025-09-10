<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealStoreRequest;
use App\Models\Meal;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class MealController extends Controller
{
    public function index(): Renderable
    {
        return View::make('admin.meals.index')->with([
            'meals' => Meal::all(),
        ]);
    }

    public function create(): Renderable
    {
        return View::make('admin.meals.form')->with([
            'products' => Product::all(),
        ]);
    }

    public function store(MealStoreRequest $request): RedirectResponse
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

        return Redirect::route('admin.meal.index')
            ->with(['success' => 'Meal created successfully']);
    }

    public function edit(Meal $meal): Renderable
    {
        return View::make('admin.meals.form')->with([
            'products' => Product::all(),
        ]);
    }

    public function update(MealStoreRequest $request, Meal $meal): RedirectResponse
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
        return Redirect::route('admin.meal.index')->with([
            'success' => 'Meal updated successfully']
        );
    }

    public function destroy(Meal $meal)
    {
        // first delete image file
        if ($meal->image) {
            Storage::delete($meal->image);
        }

        // now delete menu
        $meal->delete();

        //redirect to index page
        return to_route('admin.meal.index')->with('success', 'Meal deleted successfully');
    }
}
