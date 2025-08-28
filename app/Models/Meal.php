<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperMeal
 */
class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description'
    ];

    public function getImageAttribute($value): string
    {
        return $value && Storage::exists($value)
            ? asset(Storage::url($value))
            : asset('/assets/images/unavailable.jpg');
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'meal_product');
    }

    public function scopeSearch(Builder $query, ?string $input): Builder
    {
        return $query->when($input, function ($query) use ($input) {
            return $query->where('name', 'LIKE', '%' . $input . '%')
                ->orWhere('description', 'LIKE', '%' . $input . '%');
        });
    }
}
