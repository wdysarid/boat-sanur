<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // $roles sudah berupa array berkat ...$roles
    if (!in_array($user->role, $roles)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
    }
}
