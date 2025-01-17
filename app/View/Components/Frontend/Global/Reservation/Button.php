<?php

namespace App\View\Components\Frontend\Global\Reservation;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    public string $url;
    public string $classes;
    public string $text;

    public function __construct(public bool $isButton = false) {
        $this->url = route('reservation.create');
        $this->text = 'Make reservation';
        $this->classes = 'items-center justify-center px-6 py-2 text-base font-bold leading-6 bg-green-600 hover:bg-green-500 w-auto text-white';
    }

    public function render(): View
    {
        return view('components.frontend.global.reservation.button');
    }
}