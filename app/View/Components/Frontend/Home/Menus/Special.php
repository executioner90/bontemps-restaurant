<?php

namespace App\View\Components\Frontend\Home\Menus;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Special extends Component
{
    public Collection $specials;

    public function __construct()
    {
        $this->specials = Menu::query()
            ->where('special', 1)
            ->get();
    }

    public function render(): View
    {
        return view('components.frontend.home.menus.special');
    }
}
