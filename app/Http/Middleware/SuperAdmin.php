<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SuperAdmin
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::user()->is_super_admin) {
            return Redirect::back()->with([
                'danger' => 'Unauthorized action'
            ]);
        }

        return $next($request);
    }
}
