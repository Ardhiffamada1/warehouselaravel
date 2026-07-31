<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // WAJIB ADA INI BOS
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Menggunakan Auth Facade agar Intelephense tidak error
        if (!Auth::check() || !in_array($request->user()->role, $roles)) {
            abort(403, 'Akses Dibatalkan: Anda tidak memiliki wewenang.');
        }

        return $next($request);
    }
}