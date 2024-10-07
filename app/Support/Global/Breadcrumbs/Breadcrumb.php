<?php

namespace App\Support\Global\Breadcrumbs;

class Breadcrumb
{
    public string $title;
    public ?string $url;

    public function __construct(string $title, ?string $url = null)
    {
        $this->title = $title;
        $this->url = $url;
    }
}
