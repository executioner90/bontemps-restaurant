<?php

namespace App\Observers;

use App\Helpers\SlugHelper;
use App\Models\Menu;

class MenuObserver
{
    public function created(Menu $menu): void
    {
        SlugHelper::updateSlug($menu);
    }

    public function updated(Menu $menu): void
    {
        if ($menu->isDirty('name')) {
            SlugHelper::updateSlug($menu);
        }
    }
}
