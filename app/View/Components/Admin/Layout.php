<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class Layout extends Component
{
    public function render(): View
    {
        return view('layouts.admin.layout');
    }
}
