<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Support\Global\Breadcrumbs;
use Illuminate\View\View;

class TermsController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Terms & Conditions', route('terms'));

        return view('frontend.terms', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
