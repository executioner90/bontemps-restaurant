<?php

namespace App\View\Components\Frontend\Menus;

use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\View\View;

class Block extends Component
{
    public function __construct(public Menu $menu)
    {
        //
    }

    public function render(): View
    {
        return view('components.frontend.menus.block');
    }
}
