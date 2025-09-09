<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperReservation
 */
class Reservation extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'email',
        'date',
        'total_guests',
        'status',
        'status_changed_at',
        'note',
    ];

    protected $casts = [
        'status' => ReservationStatus::class,
    ];

    public function timeSlots(): BelongsToMany
    {
        return $this->belongsToMany(TimeSlot::class, 'reservations_time_slots');
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . " " . $this->last_name,
        );
    }

    public function scopeSearchFilter(Builder $query, $term): Builder
    {
        return $query->where('first_name', 'like', "%{$term}%")
            ->orWhere('last_name', 'like', "%{$term}%");
    }

}
