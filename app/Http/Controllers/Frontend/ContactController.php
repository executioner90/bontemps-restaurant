<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Support\Global\Breadcrumbs;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Contact', route('contact'));

        return view('frontend.contact', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
