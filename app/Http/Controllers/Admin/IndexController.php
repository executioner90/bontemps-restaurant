<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class IndexController extends Controller
{
    public function index(): Renderable
    {
        return view('admin.index');
    }
}
