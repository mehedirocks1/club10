<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Branch;
use App\Models\Contact; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ResetPasswordMail; 
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;


class BackendController extends Controller
{
    public function viewProfile()
    {
        $admin = auth()->user();
        if ($admin->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('backend.admin.profile.view', compact('admin'));
    }

    public function editProfile()
    {
        $admin = auth()->user();
        if ($admin->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('backend.admin.profile.edit', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'mobile_number' => 'required|numeric',
            'nid' => 'required|string|max:17',
            'dob' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required|string',
            'blood_group' => 'nullable|string|max:5',
            'education' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'thana' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $admin = auth()->user();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($admin->photo) {
                $oldPhotoPath = public_path('profilepics/' . $admin->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $timestamp = time();
            $photoName = $request->first_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension();
            $photoPath = $request->file('photo')->move(public_path('profilepics'), $photoName);
            $validatedData['photo'] = 'profilepics/' . $photoName;
        }

        $admin->update($validatedData);
        return redirect()->route('admin.viewProfile')->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        $admin = auth()->user();
        if ($admin->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('backend.admin.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $admin = auth()->user();
        if ($admin->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.viewProfile')->with('success', 'Password changed successfully.');
    }
}
