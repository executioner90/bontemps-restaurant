<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function index()
    {
        return view('terms');
    }
}
