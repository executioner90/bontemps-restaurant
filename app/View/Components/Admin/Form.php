<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class Form extends Component
{
    public function __construct(
        public string $title,
        public string $method,
        public string $action,
        public string $backRoute,
        public string $submitButton,
    )
    {
        //
    }

    public function render(): View
    {
        return view('components.admin.form');
    }
}
