<?php

namespace App\View\Components\Admin\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public ?string $label,
        public string $id,
        public string $name,
        public ?string $class = null,
        public string $type = 'text',
        public ?string $value = null,
        public bool $required = false,
        public ?string $placeholder = null,
        public ?bool $disabled = false,
        public ?bool $customLabel = false,
    ) {
        //
    }

    public function render(): Renderable
    {
        return view('components.admin.form.input');
    }
}
