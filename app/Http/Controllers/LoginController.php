<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /**
     * Show the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showAdminLogin()
    {   
        return view('admin.login');
    }
    public  function handleAdminLogout(Request $request)
    {

        Auth::logout();

        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.auth.login');
    }

    public function handleAdminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            $token = Auth::user()->createToken('token')->plainTextToken;
            $request->session()->put('token', $token);
            return redirect()->route('admin.auth.dashboard');

        }
        \Log::info('Failed login attempt: ' . $request->email);
        

        return redirect()->route('admin.auth.login')->withErrors([
            'email' => 'Invalid credentials provided.',
        ]);
        // return redirect('admin/login')->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }
}
