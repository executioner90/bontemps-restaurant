<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Support\Global\Breadcrumbs;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function stepOne(Request $request): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Reservation')
            ->add('Step one');

        $reservation = $request->session()->get('reservation');
        $minDate = Carbon::today();
        $maxDate = Carbon::now()->addWeek();

        return view('frontend.reservations.step-one', [
            'breadcrumbs' => $breadcrumbs,
            'reservation' => $reservation,
            'minDate' => $minDate,
            'maxDate' => $maxDate,
        ]);
    }

    public function storeStepOne(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'mobile_number' => ['required'],
            'reservation_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'guest_number' => ['required', 'numeric'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
        } else {
            $reservation =  $request->session()->get('reservation');
        }

        $reservation->fill($validated);
        // Save input values if something went wrong.
        $request->session()->put('reservation', $reservation);

        return to_route('reservations.step.two');
    }

    public function stepTwo(Request $request): View
    {
        $breadcrumbs = (new Breadcrumbs())
            ->add('Reservation')
            ->add('Step one', route('reservations.step.one'))
            ->add('Step two');

        // Get inputs value from session.
        $reservation = $request->session()->get('reservation');
        $resTableIds = Reservation::query()
            ->orderBy('reservation_date')
            ->get()
            ->filter(function ($value) use ($reservation) {
                // Filter out reservations with different dateTime.
                return Carbon::parse($value->reservation_date)->format('Y-m-d H:i') ===
                       Carbon::parse($reservation->reservation_date)->format('Y-m-d H:i');
            })
            ->pluck('table_id');
        // Get only available tables.
        $tables = Table::query()
            ->where('status', TableStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $resTableIds)
            ->get();
        $menus = Menu::all();

        return view('frontend.reservations.step-two', [
            'breadcrumbs' => $breadcrumbs,
            'tables' => $tables,
            'menus' => $menus,
            'reservation' => $reservation,
        ]);
    }

    public function storeStepTwo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'table_id' => ['required'],
        ]);

        $reservation =  $request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        // Reservation saved, delete session cache.
        $request->session()->forget('reservation');

        if ($request->has('menus')) {
            $reservation->menus()->attach($request->menus);
        }

        return to_route('thank.you');
    }
}
