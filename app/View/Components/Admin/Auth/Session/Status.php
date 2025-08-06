<?php

namespace App\View\Components\Admin\Auth\Session;

use Illuminate\View\Component;
use Illuminate\View\View;

class Status extends Component
{
    public function __construct(public ?string $status)
    {
        //
    }

    public function shouldRender(): bool
    {
        return $this->status !== null;
    }

    public function render(): View
    {
        return view('components.admin.auth.session.status');
    }
}
