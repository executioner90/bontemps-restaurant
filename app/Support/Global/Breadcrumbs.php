<?php

namespace App\Support\Global;

use App\Support\Global\Breadcrumbs\Breadcrumb;

class Breadcrumbs
{
    public array $breadcrumbs = [];

    public function add(string $title, ?string $url = null): self
    {
        $this->breadcrumbs[] = new Breadcrumb($title, $url);
        return $this;
    }

    public function get(): array
    {
        return $this->breadcrumbs;
    }
}
