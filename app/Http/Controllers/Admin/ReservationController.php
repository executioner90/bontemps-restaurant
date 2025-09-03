<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::query()
            ->with(['timeSlots'])
            ->orderBy('date', 'ASC')
            ->get()
            ->filter(function ($value) {
                // Get only today's reservations
                return Carbon::parse($value->date)->format('Y-m-d') ===
                    Carbon::today()->format('Y-m-d');
            });

        $reservationConfirmed = ReservationStatus::CONFIRMED;

        return view('admin.reservations.index', compact('reservations', 'reservationConfirmed'));
    }

    public function create(): View
    {
        return view('admin.reservations.form');
    }

    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        $capacity = TimeSlot::query()
            ->whereIn('id', $request->time_slot)
            ->with('table')
            ->get()
            ->sum(fn($timeSlot) => $timeSlot->table->capacity);

        if ($request->total_guests > $capacity) {
            return Redirect::route('admin.reservation.create')
                ->withInput()
                ->with([
                    'warning' => 'Given total guests need more tables/seats!'
                ]);
        }

        // Check if table already reserved.
        $reservationDate = $request->date('date');

        $alreadyReserved = Reservation::query()
            ->where('date', $reservationDate)
            ->whereHas('timeSlots', function ($query) use ($request, $reservationDate) {
                $query->whereIn('id', $request->time_slot);
            })
            ->exists();


        if ($alreadyReserved) {
            return Redirect::route('admin.reservation.create')
                ->withInput()
                ->with([
                    'warning' => 'This table is already reserved for this date'
                ]);
        }

        $reservation = Reservation::query()->create($request->validated());
        $reservation->timeSlots()->attach($request->time_slot);

        return Redirect::route('admin.reservation.index')
            ->with(['success' => 'Reservation created successfully']);
    }

    public function edit(Reservation $reservation): View
    {
        return view('admin.reservations.form');
    }

    public function update(ReservationStoreRequest $request, Reservation $reservation): RedirectResponse
    {
        $table = Table::query()->findOrFail($request->table_id);

        // Check if table does not have enough seats for this reservation.
        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Table is too small, please choose another table.');
        }

        // Check if table already reserved.
        $reservationDate = Carbon::parse($request->reservation_date);
        foreach ($table->reservations as $res) {
            if (
                $res->reservation_date === $reservationDate->format('Y-m-d H:i:s') &&
                $res->id !== $reservation->id
            ) {
                return back()->with('warning', 'This table is already reserved for this date');
            }
        }

        $reservation->update($request->validated());

        if ($request->has('menus')) {
            $reservation->menus()->sync($request->menus);
        }

        return to_route('admin.reservation.index')->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();

        return to_route('admin.reservation.index')->with('success', 'Reservation deleted successfully');
    }
}
