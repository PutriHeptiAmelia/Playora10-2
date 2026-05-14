<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOnlyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role === 'admin') {
            abort(403, 'Akses ditolak. Hanya user biasa yang dapat membuat booking.');
        }

        return $next($request);
    }
}
