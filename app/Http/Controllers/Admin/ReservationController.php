<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $reservations = Reservation::query()
            ->orderBy('reservation_date', 'ASC')
            ->get()
            ->filter(function ($value) {
                // Get only today's reservations
                return Carbon::parse($value->reservation_date)->format('Y-m-d') ===
                    Carbon::today()->format('Y-m-d');
            });

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $tables = Table::query()
            ->where('status', TableStatus::Available)
            ->get();
        $menus = Menu::all();

        return view('admin.reservations.create', compact('tables', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        $table = Table::query()->findOrFail($request->table_id);

        // Check if table does not have enough seats for this reservation.
        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Table is too small, please choose another table.');
        }

        // Check if table already reserved.
        $reservationDate = Carbon::parse($request->reservation_date);

        foreach ($table->reservations as $reservation) {
            if ($reservation->reservation_date === $reservationDate->format('Y-m-d H:i:s')) {
                return back()->with('warning', 'This table is already reserved for this date');
            }
        }

        $reservation = Reservation::query()->create($request->validated());

        if ($request->has('menus')) {
            $reservation->menus()->attach($request->menus);
        }

        return to_route('admin.reservations.index')->with('success', 'Reservation created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation): View
    {
        $tables = Table::query()
            ->where('status', TableStatus::Available)
            ->get();
        $menus = Menu::all();

        return view('admin.reservations.edit', compact('reservation', 'tables', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return to_route('admin.reservations.index')->with('success', 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();

        return to_route('admin.reservations.index')->with('success', 'Reservation deleted successfully');
    }
}
