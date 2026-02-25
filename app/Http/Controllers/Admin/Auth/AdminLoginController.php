<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\ActivityLog;

class AdminLoginController extends Controller
{
    // Show the login form
    public function create()
    {
        return view('admin.auth.login');
    }

    // Handle the login request
    // Handle the login request
    public function store(Request $request)
    {
        // 1. Define a unique key for this user based on their IP
        $throttleKey = 'admin-login:' . $request->ip();

        // 2. Check if they have tried too many times (5 attempts max)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 3. Attempt to log in
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Success! Clear their failure count so they start fresh next time
            RateLimiter::clear($throttleKey);

            // --- NEW CODE STARTS HERE ---
            ActivityLog::create([
                'user_id' => Auth::guard('admin')->id(),
                'action'  => 'ADMIN_LOGIN',
                'details' => 'Logged in from IP: ' . $request->ip(),
            ]);
            // --- NEW CODE ENDS HERE ---
            
            return redirect()->intended(route('admin.courses.index'));
        }

        // 4. Login failed? Count it as a "hit"
        RateLimiter::hit($throttleKey);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    // Handle logout
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}