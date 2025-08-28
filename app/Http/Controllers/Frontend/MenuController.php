<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Support\Global\Breadcrumbs;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Menus', route('menu.index'));

        return view('frontend.menus.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function show(Menu $menu): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Home', route('home'))
            ->add('Menus', route('menu.index'))
            ->add($menu->name);

        return view('frontend.menus.show', [
            'menu' => $menu,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
