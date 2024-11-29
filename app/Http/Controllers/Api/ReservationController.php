<?php

namespace App\Http\Controllers\Api;

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
            'totalGuests' => ['required', 'numeric', 'min:1', 'max:'. Table::query()->max('capacity')],
        ]);

        $date = Carbon::parse($request->get('date'))->format('Y-m-d');
        $totalGuests = (int)$request->get('totalGuests');
        $tables = Table::query()->where('capacity', $totalGuests)->pluck('id');

        // If no exact matches, check the range
        if ($tables->isEmpty()) {
            $tables = Table::query()
                ->whereBetween('capacity', [$totalGuests, (int)round($totalGuests * 1.5)])
                ->pluck('id');
        }

        // If no range matches, check for larger capacities
        if ($tables->isEmpty()) {
            $tables = Table::query()
                ->where('capacity', '>', $totalGuests)
                ->orderBy('capacity')
                ->pluck('id');
        }

        $availableTimes = TimeSlot::query()
            ->whereDoesntHave('reservations', function ($query) use ($date) {
                $query->whereIn('status', ReservationStatus::getReservedStatus())
                    ->where('date', $date);
            })
            ->whereHas('table', function ($query) use ($tables) {
                $query->whereIn('id', $tables);
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
