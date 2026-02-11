<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RefreshRememberToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if the user is logged in via the "Remember Me" cookie
        if (Auth::viaRemember()) {
            $user = Auth::user();
            $lastRefreshed = session('remember_token_refreshed_at');

            // Refresh if it hasn't been refreshed this session OR it's been > 60 minutes
            if (! $lastRefreshed || now()->diffInMinutes($lastRefreshed) > 60) {
                
                // 1. Generate a new token
                $token = Str::random(60);
                
                // 2. Save it to the user (User model handles encryption automatically)
                $user->remember_token = $token;
                $user->save();

                // 3. Queue the new cookie for the browser
                Auth::guard()->queueRecallerCookie($user);

                // 4. Update the session tracker so we don't refresh again immediately
                session(['remember_token_refreshed_at' => now()]);
            }
        }

        return $response;
    }
}