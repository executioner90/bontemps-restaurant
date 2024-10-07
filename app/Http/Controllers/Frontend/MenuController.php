<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Support\Global\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Menus', route('menus.index'));

        return view('frontend.menus.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function show(Menu $menu): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Menus', route('menus.index'))
            ->add($menu->name);

        return view('frontend.menus.show', [
            'meals' => $menu->meals,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
