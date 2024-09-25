<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('frontend.about-us.index');
    }
}
