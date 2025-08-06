<?php

namespace App\View\Components\Admin\Form\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Error extends Component
{
    public function __construct(public ?array $messages = [])
    {
        //
    }

    public function render(): Renderable
    {
        return view('components.admin.form.input.error');
    }
}