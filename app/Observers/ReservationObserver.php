<?php

namespace App\Observers;

use App\Enums\ReservationStatus;
use App\Enums\TableStatus;
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
            foreach ($reservation->timeslots() as $timeslot) {
                if (in_array($reservation->status, ReservationStatus::getReservedStatus())) {
                    $timeslot->status = TableStatus::RESERVED;
                } else {
                    $timeslot->status = TableStatus::AVAILABLE;
                }
            }
        }
    }
}
