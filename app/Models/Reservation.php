<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperReservation
 */
class Reservation extends Model
{
    use HasFactory;

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
}
