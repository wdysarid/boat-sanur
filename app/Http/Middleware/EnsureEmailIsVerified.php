<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && is_null(Auth::user()->email_verified_at)) {
            return redirect()->route('verification.notice')
                ->with('warning', 'Silakan verifikasi email Anda terlebih dahulu.');
        }

        return $next($request);
    }
}
