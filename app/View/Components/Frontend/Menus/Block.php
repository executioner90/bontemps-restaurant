<?php

namespace App\View\Components\Frontend\Menus;

use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class Block extends Component
{
    public string $image;

    public function __construct(
        public Menu $menu,
    )
    {
        $this->image = $menu->image && Storage::exists($menu->image) ?
            asset(Storage::url($menu->image)) :
            asset('/asset/images/unavailable.jpg');
    }

    public function render(): View
    {
        return view('components.frontend.menus.block');
    }
}
