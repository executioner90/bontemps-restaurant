<?php

namespace App\View\Components\Frontend;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Meals extends Component
{
    public function __construct(public Collection $meals)
    {
        //
    }

    public function render(): View
    {
        return view('components.frontend.meals');
    }
}
