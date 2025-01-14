<?php

namespace App\Observers;

use App\Helpers\SlugHelper;
use App\Models\Meal;

class MealObserver
{
    public function created(Meal $meal): void
    {
        SlugHelper::updateSlug($meal);
    }

    public function updated(Meal $meal): void
    {
        if ($meal->isDirty('name')) {
            SlugHelper::updateSlug($meal);
        }
    }
}
