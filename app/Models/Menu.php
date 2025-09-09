<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperMenu
 */
class Menu extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'special',
        'description',
        'image',
    ];

    public function getRouteKeyName(): string
    {
        if (request()->routeIs('admin.*')) {
            return 'id';
        }

        return 'slug';
    }

    public function getImageAttribute($value): string
    {
        return $value && Storage::disk('menus')->exists($value)
            ? asset(Storage::disk('menus')->url($value))
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
        return $query->when(
            $input,
            fn($query) => $query->where('name', 'LIKE', '%' . $input . '%')
        );
    }
}
