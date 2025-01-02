<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function user()
    {
        // Check if the logged-in user has role_id 3 (user)
        if (Auth::check() && Auth::user()->role_id !== 3) {
            // Unauthorized access if not a user
            abort(403, 'Unauthorized access');
        }
        return view('backend.user.dashboard'); // Return the user dashboard view
    }

    // Show staff dashboard
    public function staff()
    {
        // Check if the logged-in user has role_id 2 (staff)
        if (Auth::check() && Auth::user()->role_id !== 2) {
            // Unauthorized access if not a staff member
            abort(403, 'Unauthorized access');
        }
        return view('backend.staff.dashboard'); // Return the staff dashboard view
    }

    // Show admin dashboard
    public function admin()
    {
        // Check if the logged-in user has role_id 1 (admin)
        if (Auth::check() && Auth::user()->role_id !== 1) {
            // Unauthorized access if not an admin
            abort(403, 'Unauthorized access');
        }
        return view('backend.admin.dashboard'); // Return the admin dashboard view
    }
}
