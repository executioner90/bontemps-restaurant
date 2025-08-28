<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController
{
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'search' => ['nullable', 'string'],
            'isSpecial' => ['nullable', 'in:true,false,1,0'],
        ]);

        $menus = Menu::search($request->get('search'))
            ->when(
                $request->boolean('isSpecial'),
                fn ($query) => $query->where('special', true)
            )
            ->get()
            ->toArray();


        return response()->json($menus);
    }

    public function show(Menu $menu, Request $request): JsonResponse
    {
        $request->validate(['search' => ['nullable', 'string']]);

        $meals = $menu->meals()
            ->search($request->get('search'))
            ->get()
            ->toArray();

        return response()->json($meals);
    }
}
