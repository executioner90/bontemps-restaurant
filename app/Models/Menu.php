<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $special
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Meal> $meals
 * @property-read int|null $meals_count
 * @property-read Collection<int, Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereDescription($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereImage($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereSpecial($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @method static Builder|Menu search(?string $input)
 * @mixin Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'special',
        'description',
        'image',
    ];

    public function getImageAttribute($value): string
    {
        return $value && Storage::exists($value)
            ? asset(Storage::url($value))
            : asset('/assets/images/unavailable.jpg');
    }

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservation_menu');
    }

    public function scopeSearch(Builder $query, ?string $input): Builder
    {
        if (empty($input)) {
            return $query;
        }

        return $query->where('name', 'LIKE', '%' . $input . '%');
    }
}
