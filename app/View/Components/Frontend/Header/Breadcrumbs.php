<?php

namespace App\View\Components\Frontend\Header;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use App\Support\Global\Breadcrumbs as BreadcrumbsModel;

class Breadcrumbs extends Component
{
    public array $breadcrumbs;
    public bool $isHome;

    public function __construct(BreadcrumbsModel $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs->get();
        $this->isHome = Route::is('home');
    }

    public function render(): Renderable
    {
        return view('components.frontend.header.breadcrumbs');
    }
}
