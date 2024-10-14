<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenusController
{
    public function index(): JsonResponse
    {
        return response()->json(
            Menu::all()->toArray()
        );
    }

    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => ['nullable', 'string'],
        ]);

        return response()->json(
            Menu::query()->search($request->input('query'))->get()->toArray()
        );
    }
}
