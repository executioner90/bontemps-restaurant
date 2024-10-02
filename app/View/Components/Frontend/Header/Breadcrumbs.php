<?php

namespace App\View\Components\Frontend\Header;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use App\Support\Global\Breadcrumbs as BreadcrumbsModel;

class Breadcrumbs extends Component
{
    public array $breadcrumbs;

    public function __construct(BreadcrumbsModel $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs->get();
    }

    public function render(): Renderable
    {
        return view('components.frontend.header.breadcrumbs');
    }
}
