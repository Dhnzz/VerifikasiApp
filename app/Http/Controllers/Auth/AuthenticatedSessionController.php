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
        $request->authenticate(); // Melakukan autentikasi pengguna berdasarkan data yang diberikan dalam request
        $request->session()->regenerate(); // Membuat session baru untuk menggantikan session yang lama, ini membantu mencegah serangan session fixation
        if (Auth::user()->role === 'super_admin') {
            return redirect()->intended(route('admin.dashboard'));
        } elseif (Auth::user()->role === 'dosen') {
            return redirect()->intended(route('dashboard_dosen'));
        } elseif (Auth::user()->role === 'mahasiswa'){
            return redirect()->intended(route('dashboard_student'));
        }

        return redirect()->intended(route('base'))->with('error','User Tidak Memiliki Role');
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
