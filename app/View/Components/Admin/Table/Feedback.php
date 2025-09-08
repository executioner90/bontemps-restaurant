<?php

namespace App\View\Components\Admin\Table;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Feedback extends Component
{
    public function __construct(
        public int $totalItems,
        public int $colspan
    ) {
        //
    }

    public function shouldRender(): bool
    {
        return $this->totalItems < 1;
    }

    public function render()
    {
        return View::make('components.admin.table.feedback');
    }
}
