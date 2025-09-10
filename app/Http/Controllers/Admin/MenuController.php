<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Menu;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('Menu'), URL::route('admin.menu.index'));
    }

    public function index(): Renderable
    {
        $menus = Menu::all();

        return View::make('admin.menus.index')
            ->with([
                'menus' => $menus,
                'breadcrumbs' => $this->breadcrumbs,
            ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.menu.create'));

        return View::make('admin.menus.form')
            ->with([
                'breadcrumbs' => $this->breadcrumbs,
                'title' => Lang::get('Create menu'),
                'method' => 'POST',
                'action' => URL::route('admin.menu.store'),
                'backRoute' => URL::route('admin.menu.index'),
                'submitButton' => Lang::get('Create'),

            ]);
    }

    public function store(MenuStoreRequest $request): RedirectResponse
    {
        $image = $this->saveImage($request->file('image'));

        Menu::query()->create([
            'name' => $request->name,
            'special' => $request->has('special') ? 1 : 0,
            'image' => $image,
        ]);

        return Redirect::route('admin.menu.index')
            ->with([
                'success' => 'Menu created successfully',
            ]);
    }

    public function edit(Menu $menu): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.menu.edit', ['menu' => $menu->id]));

        return View::make('admin.menus.form')
            ->with([
                'menu' => $menu,
                'breadcrumbs' => $this->breadcrumbs,
                'title' => Lang::get('Update menu'),
                'method' => 'Put',
                'action' => URL::route('admin.menu.update', ['menu' => $menu->id]),
                'backRoute' => URL::route('admin.menu.index'),
                'submitButton' => Lang::get('Update'),
            ]);
    }

    public function update(MenuStoreRequest $request, Menu $menu): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'special' => $request->has('special') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            // delete old image
            Storage::disk('menus')->delete($menu->getRawOriginal('image'));

            // save new image
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $menu->update($data);

        //redirect to index page
        return Redirect::route('admin.menu.index')
            ->with(['success' => 'Menu updated successfully']);
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        // first delete image file
        if ($menu->image) {
            Storage::disk('menus')->delete($menu->image);
        }

        // now delete menu
        $menu->delete();

        //redirect to index page
        return Redirect::route('admin.menu.index')
            ->with(['success' => 'Menu deleted successfully']);
    }

    protected function saveImage(?UploadedFile $file): string|null
    {
        if (!$file) {
            return null;
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $originalName . '_' . time() . '.' . $extension;

        return $file->storeAs('', $fileName, 'menus');
    }
}
