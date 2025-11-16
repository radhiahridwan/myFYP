<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if user is admin
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
