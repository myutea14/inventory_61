<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login dan rolenya sesuai
        if (!$request->user() || $request->user()->role !== $role) {
            return response()->json(['message' => '403 Forbidden: Anda bukan Admin!'], 403);
        }

        return $next($request);
    }
}