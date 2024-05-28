<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name
 * @property boolean $special
 * @property string $description
 * @property string $image
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
 * @property-read int|null $meals_count
 * @property-read Collection<int, Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static Builder|Menu whereSpecial($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'special',
        'description',
        'image',
    ];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_menu');
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservation_menu');
    }
}
