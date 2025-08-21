<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Meal;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meals = Meal::all();

        return view('admin.menus.create', compact('meals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        $image = $request->file('image') ? $request->file('image')->store('public/menus') : null;

        $menu = Menu::query()->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
        ]);

        // If check box checked set special true
        if (isset($request->special)) {
            $menu->special = 1;
            $menu->save();
        }

        // If menu has meals attached to it, save them.
        if ($request->has('meals')) {
           $menu->meals()->attach($request->meals);
        }

        return to_route('admin.menu.index')->with('success', 'Menu created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $meals = Meal::all();

        return view('admin.menus.edit', compact('menu', 'meals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        // validate inputs
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'between:0.00,200.00'],
            'image' => ['image', 'nullable'],
            'description' => ['required'],
        ]);

        $image = $menu->image;
        // check if image input has file
        if ($request->hasFile('image')) {
            // delete old image
            Storage::delete($menu->image);
            // save uploaded image
            $image = $request->file('image') ? $request->file('image')->store('public/menus') : null;
        }

        // check special checkbox
        $special = isset($request->special) ? 1 : 0;

        $menu->update([
            'name' => $request->name,
            'special' => $special,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
        ]);

        if ($request->has('meals')) {
            $menu->meals()->sync($request->meals);
        }

        //redirect to index page
        return to_route('admin.menu.index')->with('success', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // first delete image file
        if ($menu->image) {
            Storage::delete($menu->image);
        }

        // now delete menu
        $menu->delete();

        //redirect to index page
        return to_route('admin.menu.index')->with('success', 'Menu deleted successfully');
    }
}
