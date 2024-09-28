<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        return view('frontend.menus.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        return view('frontend.menus.show', compact('menu'));
    }
}
