<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
/**
     * Show the login form.
     */
    public function showForm()
    {
        return view('frontend.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication was successful, now check the role
            $user = Auth::user();

            // Redirect based on role
            switch ($user->role_id) {
                case 1: // Admin
                    return redirect()->route('backend.admin.dashboard');
                case 2: // Staff
                    return redirect()->route('backend.staff.dashboard');
                case 3: // User
                    return redirect()->route('backend.user.dashboard');
                default:
                    // If the role is unknown, logout the user
                    Auth::logout();
                    return redirect()->route('login.form')->with('error', 'Invalid role.');
            }
        }

        // If authentication fails, redirect back with error message
        return back()->with('error', 'Invalid credentials. Please try again.');
    }
}
