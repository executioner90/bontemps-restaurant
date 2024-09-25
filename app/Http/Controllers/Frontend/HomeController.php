<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $specials = Menu::query()
            ->where('special', 1)
            ->get();

        return view('frontend.home', compact('specials'));
    }

    public function thankYou()
    {
        return view('frontend.thanks');
    }
}
