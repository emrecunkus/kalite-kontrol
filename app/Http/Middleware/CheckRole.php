<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Log middleware execution
        Log::info('CheckRole middleware is running', [
            'expected_role' => $role,
            'session_role' => $request->session()->get('role')
        ]);

        // Check if role matches
        if ($request->session()->get('role') !== $role) {
            Log::warning('Role mismatch, redirecting to login', [
                'expected_role' => $role,
                'session_role' => $request->session()->get('role')
            ]);
            return redirect('/login')->withErrors(['error' => 'Unauthorized role']);
        }

        return $next($request);
    }
}
