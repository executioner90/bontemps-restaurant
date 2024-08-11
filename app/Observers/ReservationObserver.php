<?php

namespace App\Observers;

use App\Models\Reservation;
use Carbon\Carbon;

class ReservationObserver
{
    public function updated(Reservation $reservation): void
    {
        if (
            $reservation->isDirty('confirmed') &&
            $reservation->confirmed
        ) {
            $reservation->confirmed_at = Carbon::now();
        }
    }
}
