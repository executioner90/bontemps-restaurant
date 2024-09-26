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

        return view('frontend.home');
    }

    public function thankYou()
    {
        return view('frontend.reservations.thanks');
    }
}
