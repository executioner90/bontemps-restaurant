<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property BelongsToMany|null $meals
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereDescription($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereImage($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu wherePrice($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_menu');
    }
}
