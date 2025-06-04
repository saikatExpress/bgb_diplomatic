<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Jenssegers\Agent\Agent;
use App\Models\LoginActivity;
use App\Providers\RouteServiceProvider;
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
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();

        $agent = new Agent();

        $activity             = new LoginActivity();
        $activity->user_id    = $user->id;
        $activity->device     = $agent->device();
        $activity->platform   = $agent->platform();
        $activity->browser    = $agent->browser();
        $activity->ip_address = $request->ip();
        $activity->login_at   = now();
        $activity->save();

        session(['login_activity_id' => $activity->id]);

        $role = $user->role;

        if($role == 'super-admin'){
            return redirect()->route('super_admin.dashboard');
        }else if($role == 'user'){
            return redirect()->route('dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
    */
    public function destroy(Request $request): RedirectResponse
    {
        $activityId = session('login_activity_id');

        if ($activityId) {
            LoginActivity::where('id', $activityId)->update([
                'logout_at' => now()
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}