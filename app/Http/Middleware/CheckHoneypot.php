<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHoneypot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    // If the 'phone_number' field is present and not empty, it's a bot.
        if ($request->filled('phone_number')) {
        // We can just abort, or redirect them back silently.
        // Aborting ensures they know they failed.
        abort(403, 'Spam detected.');
    }

        return $next($request);
    }
}
