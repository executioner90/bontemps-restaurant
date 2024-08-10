<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $unit
 * @property float|null $min_available
 * @property float|null $max_available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $meals
 * @property-read int|null $meals_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereMaxAvailable($value)
 * @method static Builder|Product whereMinAvailable($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereUnit($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'min_available',
        'max_available',
    ];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_product');
    }
}
