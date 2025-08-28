<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Support\Global\Breadcrumbs;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs());

        return view('frontend.home', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
