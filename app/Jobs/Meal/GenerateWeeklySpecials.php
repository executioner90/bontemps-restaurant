<?php

namespace App\Jobs\Meal;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class GenerateWeeklySpecials implements ShouldQueue
{
    use Dispatchable;

    public function handle(): void
    {
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek   = Carbon::now()->subWeek()->endOfWeek();

        $menuCounts = DB::table('reservations')
            ->join('reservations_meals', 'reservations.id', '=', 'reservations_meals.reservation_id')
            ->join('meals', 'reservations_meals.meal_id', '=', 'meals.id')
            ->join('menus', 'meals.menu_id', '=', 'menus.id')
            ->whereBetween('reservations.date', [$startOfWeek, $endOfWeek])
            ->select('menus.id', DB::raw('count(*) as total'))
            ->groupBy('menus.id')
            ->orderByDesc('total')
            ->take(4)
            ->pluck('id');

        // If no menus ordered → pick random
        if ($menuCounts->isEmpty()) {
            $menuCounts = Menu::query()->inRandomOrder()->take(4)->pluck('id');
        }

        // Reset all menus
        Menu::query()->update(['special' => false]);

        // Mark selected menus as special
        Menu::query()
            ->whereIn('id', $menuCounts)
            ->update(['special' => true]);
    }
}
