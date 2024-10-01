<?php

namespace App\View\Components\Frontend;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Menus extends Component
{
    public Collection $menus;

    public function __construct()
    {
        $this->menus = Menu::all();
    }

    public function render(): View
    {
        return view('components.frontend.menus');
    }
}
