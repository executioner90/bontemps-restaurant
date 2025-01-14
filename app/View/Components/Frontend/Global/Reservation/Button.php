<?php

namespace App\View\Components\Frontend\Global\Reservation;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    public string $url;

    public function __construct(public bool $button = false)
    {
        $this->url = route('reservation.create');
    }

    public function render(): View
    {
        return view('components.frontend.global.reservation.button');
    }
}