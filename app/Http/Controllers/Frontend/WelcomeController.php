<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class WelcomeController extends Controller
{
    public function index()
    {
        $specials = Menu::query()
            ->where('special', 1)
            ->get();

        return view('welcome', compact('specials'));
    }

    public function thankYou()
    {
        return view('thanks');
    }
}
