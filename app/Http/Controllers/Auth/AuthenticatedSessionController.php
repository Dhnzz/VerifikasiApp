<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->role == 'super_admin') {
            return redirect()->intended(route('admin.dashboard', absolute:false));
        } elseif (Auth::user()->role == 'dosen') {
            Log::info('Redirecting to dosen dashboard');
            return redirect()->intended(route('dosen.dashboard'));
        } elseif (Auth::user()->role == 'mahasiswa') {
            Log::info('Redirecting to mahasiswa dashboard');
            return redirect()->intended(route('mahasiswa.dashboard'));
        } else {
            Log::info('User does not have a recognized role, redirecting to login');
            Auth::logout();
            return redirect('/')->withErrors(['error' => 'User Tidak Memiliki Role yang Dikenali']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
