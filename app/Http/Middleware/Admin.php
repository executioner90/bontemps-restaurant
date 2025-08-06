<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Admin
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
