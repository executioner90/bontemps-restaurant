<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugHelper
{
    public static function updateSlug(
        Model  $model,
        string $sourceField = 'name',
        string $targetField = 'slug'
    ): void
    {
        if (!$model->getKey()) {
            return;
        }

        $model->{$targetField} = Str::slug($model->{$sourceField});
        $model->saveQuietly();
    }
}