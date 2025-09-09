<?php

namespace App\Http\Controllers\Admin\Api;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController
{
    public function index(Request $request): array
    {
        $request->validate([
            'view' => ['nullable', 'string', 'in:all,old,today,tomorrow,future']
        ]);

        $view = $request->input('view') ?? 'today';

        $query = Reservation::query()
            ->with(['timeSlots.table'])
            ->orderBy('date', 'ASC');

        match ($view) {
            'old' => $query->whereDate('date', '<', Carbon::today()->format('Y-m-d')),
            'today' => $query->whereDate('date', Carbon::today()->format('Y-m-d')),
            'tomorrow' => $query->whereDate('date', Carbon::today()->addDay()->format('Y-m-d')),
            'future' => $query->whereDate('date', '>', Carbon::today()->addDay()->format('Y-m-d')),
            'all' => null,
        };

        return $query->get()->toArray();
    }

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
