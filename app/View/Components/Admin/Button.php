<?php

namespace App\View\Components\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Button extends Component
{
    protected const PRIMARY = 'primary';
    protected const SECONDARY = 'secondary';
    protected const DANGER = 'danger';

    public string $class;

    public function __construct(
        public string $button = self::PRIMARY,
        public string $label = 'Button',
    ) {
        match ($this->button) {
            self::PRIMARY => $this->class = 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-100 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
            self::SECONDARY => $this->class = 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150',
            self::DANGER => $this->class = 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
        };
    }

    public function render(): Renderable
    {
        return view('components.admin.button');
    }
}
