<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MealController
{
    public function index(Menu $menu): JsonResponse
    {
        return response()->json(
            $menu->meals->toArray()
        );
    }

    public function search(Menu $menu, Request $request): JsonResponse
    {
        $request->validate([
            'query' => ['nullable', 'string'],
        ]);

        return response()->json(
            $menu->meals()->search($request->input('query'))->get()->toArray()
        );
    }
}
