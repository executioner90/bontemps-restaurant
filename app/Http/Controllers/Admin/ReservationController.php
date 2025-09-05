<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReservationController extends Controller
{
    public function index(): Renderable
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

    public function create(): Renderable
    {
        return View::make('admin.reservations.form')
            ->with([
                'title' => Lang::get('Create reservation'),
                'method' => 'POST',
                'action' => URL::route('admin.reservation.store'),
                'backRoute' => URL::route('admin.reservation.index'),
                'submitButton' => Lang::get('Create'),
            ]);
    }

    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        if ($redirect = $this->checkReservationValidity($request)) {
            return $redirect;
        }

        $reservation = Reservation::query()->create($request->validated());
        $reservation->timeSlots()->attach($request->time_slot);

        return Redirect::route('admin.reservation.index')
            ->with(['success' => 'Reservation created successfully']);
    }

    public function edit(Reservation $reservation): Renderable
    {
        return View::make('admin.reservations.form')
            ->with([
                'reservation' => $reservation,
                'title' => Lang::get('Update reservation'),
                'method' => 'PUT',
                'action' => URL::route('admin.reservation.update', ['reservation' => $reservation]),
                'backRoute' => URL::route('admin.reservation.index'),
                'submitButton' => Lang::get('Update'),
            ]);
    }

    public function update(ReservationStoreRequest $request, Reservation $reservation): RedirectResponse
    {
        if ($redirect = $this->checkReservationValidity($request)) {
            return $redirect;
        }

        $reservation->update($request->validated());

        if ($request->filled('time_slot')) {
            $reservation->timeSlots()->sync($request->time_slot);
        }

        return Redirect::route('admin.reservation.index')
            ->with(['success' => 'Reservation updated successfully']);
    }

    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->timeSlots()->detach();
        $reservation->delete();

        return Redirect::route('admin.reservation.index')
            ->with(['success' => 'Reservation deleted successfully']);
    }

    protected function checkReservationValidity(Request $request): RedirectResponse|null
    {
        $capacity = TimeSlot::query()
            ->whereIn('id', $request->time_slot)
            ->with('table')
            ->get()
            ->sum(fn($timeSlot) => $timeSlot->table->capacity);

        if ($request->total_guests > $capacity) {
            return Redirect::back()
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
            return Redirect::back()
                ->withInput()
                ->with([
                    'warning' => 'This table is already reserved for this date'
                ]);
        }

        return null;
    }
}
