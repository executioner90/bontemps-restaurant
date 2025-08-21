<?php

namespace App\View\Components\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Button extends Component
{
    protected const PRIMARY = 'primary';
    protected const SECONDARY = 'secondary';
    protected const DANGER = 'danger';

    public function __construct(
        public string $button = self::PRIMARY,
        public string $label = 'Button',
    ) {
        //
    }

    public function render(): Renderable
    {
        return view('components.admin.button');
    }
}
