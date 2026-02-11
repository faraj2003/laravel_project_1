<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate using the logic in LoginRequest
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on the role selected in the form
        if ($request->input('role') === 'admin') {
            return redirect()->route('admin.courses.index');
        }

        // Default Student Dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Check which guard is currently logged in to clear the token properly
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            Auth::guard('admin')->logout();
        } else {
            $user = Auth::guard('web')->user();
            Auth::guard('web')->logout();
        }

        // Clear the remember_token in the database (from our previous fix)
        if ($user) {
            $user->remember_token = null;
            $user->save();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}