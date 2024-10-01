<?php

namespace App\View\Components\Frontend\Meals;

use App\Models\Meal;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class Block extends Component
{
    public string $image;

    public function __construct(
        public Meal $meal,
    )
    {
        $this->image = $meal->image && Storage::exists($meal->image) ?
            asset(Storage::url($meal->image)) :
            asset('/asset/images/unavailable.jpg');
    }

    public function render(): View
    {
        return view('components.frontend.meals.block');
    }
}
