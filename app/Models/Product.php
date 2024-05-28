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
 * @property float $min_available
 * @property float $max_available
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property BelongsToMany|null $meals
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereUnit($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @property-read int|null $meals_count
 * @method static Builder|Product whereMaxAvailable($value)
 * @method static Builder|Product whereMinAvailable($value)
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
