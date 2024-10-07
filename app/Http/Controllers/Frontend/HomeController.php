<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Support\Global\Breadcrumbs;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Home', route('home'));

        $specials = Menu::query()
            ->where('special', 1)
            ->get();

        return view('frontend.home', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function thankYou()
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Thank you', route('thank.you'));

        return view('frontend.reservations.thanks', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
