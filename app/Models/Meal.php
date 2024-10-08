<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Meal
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $image
 * @property string $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Menu|null $menu
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 * @method static Builder|Meal newModelQuery()
 * @method static Builder|Meal newQuery()
 * @method static Builder|Meal query()
 * @method static Builder|Meal whereCreatedAt($value)
 * @method static Builder|Meal whereDescription($value)
 * @method static Builder|Meal whereId($value)
 * @method static Builder|Meal whereImage($value)
 * @method static Builder|Meal whereName($value)
 * @method static Builder|Meal wherePrice($value)
 * @method static Builder|Meal whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'meal_product');
    }
}
