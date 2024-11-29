<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Support\Global\Breadcrumbs;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function create(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Reservation');

        $minDate = Carbon::today();
        $maxDate = Carbon::now()->addWeek();

        return view('frontend.reservation.form', [
            'breadcrumbs' => $breadcrumbs,
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'maxCapacity' => Table::query()->max('capacity'),
        ]);
    }

    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        [$validated, $validatedTimeSlot] = $request->validatedWithTimeSlot();

        $reservation = Reservation::query()->create($validated);

        $reservation->timeSlots()->attach($validatedTimeSlot);

        return to_route('reservation.finish');
    }

    public function finish(): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Reservation', route('reservation.create'))
            ->add('Thank you', route('reservation.finish'));

        return view('frontend.reservation.finish', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
