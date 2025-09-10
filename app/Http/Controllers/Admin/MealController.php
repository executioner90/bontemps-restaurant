<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealStoreRequest;
use App\Models\Meal;
use App\Models\Menu;
use App\Models\Product;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MealController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('Meal'), URL::route('admin.meal.index'));
    }

    public function index(): Renderable
    {
        return View::make('admin.meals.index')->with([
            'meals' => Meal::query()
                ->with('menu')
                ->orderBy('menu_id')
                ->get(),
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.meal.create'));

        return View::make('admin.meals.form')->with([
            'products' => Product::all(),
            'menus' => Menu::all(),
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Create meal'),
            'method' => 'POST',
            'action' => URL::route('admin.meal.store'),
            'backRoute' => URL::route('admin.meal.index'),
            'submitButton' => Lang::get('Create'),
        ]);
    }

    public function store(MealStoreRequest $request): RedirectResponse
    {
        $image = $this->saveImage($request->file('image'));;

        $meal = Meal::query()->create([
            'name' => $request->name,
            'menu_id' => $request->menu,
            'price' => $request->price,
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
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.meal.edit', ['meal' => $meal->id]));

        return View::make('admin.meals.form')->with([
            'meal' => $meal,
            'products' => Product::all(),
            'menus' => Menu::all(),
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Update menu'),
            'method' => 'Put',
            'action' => URL::route('admin.meal.update', ['meal' => $meal->id]),
            'backRoute' => URL::route('admin.meal.index'),
            'submitButton' => Lang::get('Update'),
        ]);
    }

    public function update(MealStoreRequest $request, Meal $meal): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'menu_id' => $request->menu,
            'description' => $request->description,
            'price' => $request->price,
        ];

        if ($request->hasFile('image')) {
            // delete old image
            Storage::disk('meals')->delete($meal->getRawOriginal('image'));

            // save new image
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $meal->update($data);

        // edit products of current meal
        if ($request->has('products')) {
            $meal->products()->sync($request->products);
        }

        return Redirect::route('admin.meal.index')->with([
            'success' => 'Meal updated successfully']
        );
    }

    public function destroy(Meal $meal)
    {
        // first delete image file
        if ($meal->image) {
            Storage::disk('meals')->delete($meal->image);
        }

        // now delete meal
        $meal->delete();

        //redirect to index page
        return to_route('admin.meal.index')->with('success', 'Meal deleted successfully');
    }

    protected function saveImage(?UploadedFile $file): string|null
    {
        if (!$file) {
            return null;
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $originalName . '_' . time() . '.' . $extension;

        return $file->storeAs('', $fileName, 'meals');
    }
}
