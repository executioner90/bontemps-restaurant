<?php

namespace App\Observers;

use App\Models\Reservation;

class ReservationObserver
{
    public function created(Reservation $reservation): void
    {
        //
    }

    public function updated(Reservation $reservation): void
    {
        if ($reservation->isDirty('status')) {
            $reservation->status_changed_at = now();
        }
    }
}
