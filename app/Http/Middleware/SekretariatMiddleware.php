<?php

namespace App\Http\Middleware;

use Closure;

class SekretariatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action

        $admin = JWTAuth::user();

        if ($admin->role != "Sekretariat" || $admin->role != "SU") {
            return response([
                'message' => 'You do not have access'
            ], 403);
        }

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
