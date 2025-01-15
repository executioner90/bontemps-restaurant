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
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Meal
 *
 * @property int $id
 * @property string $name
 * @property string $slug
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
 * @method static Builder|Menu search(?string $input)
 * @mixin Eloquent
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
        if (empty($input)) {
            return $query;
        }

        return $query->where('name', 'LIKE', '%' . $input . '%')
            ->orWhere('description', 'LIKE', '%' . $input . '%');
    }
}
