<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealStoreRequest;
use App\Models\Kind;
use App\Models\Meal;
use Illuminate\Http\Request;
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
        $kinds = Kind::all();

        return view('admin.meals.create', compact('kinds'));
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

        Meal::create([
            'name' => $request->name,
            'kind_id' => (int) $request->kind,
            'description' => $request->description,
            'image' => $image,
        ]);

        return to_route('admin.meals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        $kinds = Kind::all();

        return view('admin.meals.edit', compact(['meal', 'kinds']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        // validate inputs
        $request->validate([
            'name' => 'required',
            'kind' => 'required',
            'description' => 'required',
        ]);

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
            'kind_id' => $request->kind,
            'description' => $request->description,
            'image' => $image,
        ]);

        //redirect to index page
        return to_route('admin.meals.index');
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
        return to_route('admin.meals.index');
    }
}
