<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperProduct
 */

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'unit',
        'min_available',
    ];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_product');
    }
}
