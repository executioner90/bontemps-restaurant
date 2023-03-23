<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
 * @property int $kind_id
 * @property string $description
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property BelongsTo|null $kind
 * @property BelongsToMany|null $menus
 * @method static Builder|Meal newModelQuery()
 * @method static Builder|Meal newQuery()
 * @method static Builder|Meal query()
 * @method static Builder|Meal whereCreatedAt($value)
 * @method static Builder|Meal whereDescription($value)
 * @method static Builder|Meal whereId($value)
 * @method static Builder|Meal whereImage($value)
 * @method static Builder|Meal whereName($value)
 * @method static Builder|Meal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kind_id',
        'image',
        'description'
    ];

    public function kind(): BelongsTo
    {
        return $this->belongsTo(Kind::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'meal_menu');
    }
}
