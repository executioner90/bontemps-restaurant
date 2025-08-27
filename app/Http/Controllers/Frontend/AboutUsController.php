<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Support\Global\Breadcrumbs;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('About us', route('about.us'));

        return view('frontend.about-us', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
