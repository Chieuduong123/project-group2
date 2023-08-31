<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::guard('business')->check()) {
            $user = Auth::guard('business')->user();

            if ($user && $user->tokenCan('authToken')) {
                $expiration = $user->token()->expires_at;

                if ($expiration->isBefore(now()->addMinutes(5))) {
                    $token = $user->createToken('authToken')->accessToken;
                    $response->headers->set('Authorization', 'Bearer ' . $token);
                }
            }
        }

        if (Auth::guard('seeker')->check()) {
            $user = Auth::guard('seeker')->user();

            if ($user && $user->tokenCan('authToken')) {
                $expiration = $user->token()->expires_at;

                if ($expiration->isBefore(now()->addMinutes(5))) {
                    $token = $user->createToken('authToken')->accessToken;
                    $response->headers->set('Authorization', 'Bearer ' . $token);
                }
            }
        }

        return $response;
    }
}
