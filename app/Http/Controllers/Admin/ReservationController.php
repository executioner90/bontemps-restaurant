<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Meal;
use App\Models\Reservation;
use App\Models\TimeSlot;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReservationController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('Reservations'), URL::route('admin.reservation.index'));
    }

    public function index(): Renderable
    {
        $reservationConfirmed = ReservationStatus::CONFIRMED;

        return View::make('admin.reservations.index', [
            'reservationConfirmed' => $reservationConfirmed,
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.reservation.create'));

        return View::make('admin.reservations.form')
            ->with([
                'breadcrumbs' => $this->breadcrumbs,
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
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.reservation.edit', $reservation->id));

        return View::make('admin.reservations.form')
            ->with([
                'breadcrumbs' => $this->breadcrumbs,
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

    public function order(Reservation $reservation): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Order'), URL::route('admin.reservation.order', $reservation->id));

        return View::make('admin.reservations.order')->with([
            'breadcrumbs' => $this->breadcrumbs,
            'reservation' => $reservation,
            'meals' => Meal::all()->sortBy('name'),
            'title' => Lang::get('Order'),
            'method' => 'POST',
            'action' => URL::route('admin.reservation.order', ['reservation' => $reservation]),
            'backRoute' => URL::route('admin.reservation.index'),
            'submitButton' => Lang::get('Order'),
        ]);
    }

    public function processOrder(Request $request,Reservation $reservation): RedirectResponse
    {
        $request->validate([
            'meals' => ['required', 'array'],
            'meals.*' => ['integer', 'exists:meals,id'],
            'note' => ['nullable', 'string'],
        ]);

        $reservation->meals()->sync($request->meals);
        $reservation->update($request->only('note'));

        return Redirect::route('admin.reservation.index')->with([
            'success' => 'Order placed successfully',
        ]);
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
