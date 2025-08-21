<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperMenu
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
