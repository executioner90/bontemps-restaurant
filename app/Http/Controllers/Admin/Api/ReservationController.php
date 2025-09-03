<?php

namespace App\Http\Controllers\Admin\Api;

use App\Enums\ReservationStatus;
use App\Models\Table;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController
{
    public function getAvailableTimes(Request $request): array
    {
        $request->validate([
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addWeek()->endOfDay()->format('Y-m-d')
            ],
        ]);

        $date = Carbon::parse($request->get('date'))->format('Y-m-d');

        $availableTimes = TimeSlot::query()
            ->whereDoesntHave('reservations', function ($query) use ($date) {
                $query->whereIn('status', ReservationStatus::getReservedStatus())
                    ->where('date', $date);
            })
            ->whereHas('table', function ($query)  {
                $query->whereIn('id', Table::all()->pluck('id'));
            })
            ->get();

        return $availableTimes->map(function ($availableTime) {
            $label = "Table " . $availableTime->table->number .
                " | Cap: " . $availableTime->table->capacity .
                " | " . Carbon::parse($availableTime->from)->format('H:i') .
                " - " . Carbon::parse($availableTime->till)->format('H:i');

            return [
                'id' => $availableTime->id,
                'label' => $label,
            ];
        })
            ->toArray();
    }

}
