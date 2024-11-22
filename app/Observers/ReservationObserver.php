<?php

namespace App\Observers;

use App\Models\Reservation;
use Carbon\Carbon;

class ReservationObserver
{
    public function created(Reservation $reservation): void
    {
        if ($reservation->isDirty('status')) {
            // @todo update chosen time slot status
        }
    }

    public function updated(Reservation $reservation): void
    {
        if ($reservation->isDirty('status')) {
            // @todo update chosen time slot status
        }
    }
}
