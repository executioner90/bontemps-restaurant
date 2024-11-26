<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Support\Global\Breadcrumbs;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => App::environment('production')
                ? 'required|email:rfc,dns'
                : 'required|email:rfc',
            'mobile_number' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'reservation_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'total_guests' => ['required', 'numeric'],
        ]);

        Reservation::query()->insert($validated);

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
