<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use App\Mail\ResetPasswordMail; // Assuming you have this Mail class
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Http;

class MemberController extends Controller
{
// View all members
public function viewMembers()
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $members = User::all();
    return view('backend.admin.view-members', compact('members'));
}

// View a single member's details
public function viewMember($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    return view('backend.admin.view-member', compact('member'));
}

// Download a member's details as a PDF
public function downloadMember($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    $pdf = Pdf::loadView('backend.admin.member-pdf', compact('member'));
    return $pdf->download("member_{$member->id}.pdf");
}

// Reset a member's password
public function resetPassword(Request $request, $id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $user = User::findOrFail($id);

    $newPassword = Str::random(10);
    $user->password = Hash::make($newPassword);
    $user->save();

    Mail::to($user->email)->send(new ResetPasswordMail($user, $newPassword));

    return redirect()->back()->with('success', 'Password reset successfully. New password sent to user\'s email.');
}







// Update member's status (active/inactive toggle)
public function updateStatus($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    $member->status = !$member->status;
    $member->save();

    return redirect()->route('admin.viewMembers')->with('success', 'User status updated successfully.');
}

// Edit member's details
public function edit($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    return view('backend.admin.edit-member', compact('member'));
}

// Update member's details after editing
public function update(Request $request, $id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);

    // Validation for all fields
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'mobile_number' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'district' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:255',
        'status' => 'required|boolean',
    ]);

    // Update the member with all valid request data
    $member->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'mobile_number' => $request->mobile_number,
        'country' => $request->country,
        'district' => $request->district,
        'address' => $request->address,
        'status' => $request->status,
    ]);

    // Redirect with success message
    return redirect()->route('admin.viewMembers')->with('success', 'Member details updated successfully.');
}

/*
public function destroy($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    // Find member by ID and delete
    $member = User::findOrFail($id);
    $member->delete();

    // Redirect back to members list with success message
    return redirect()->route('admin.viewMembers')->with('success', 'Member deleted successfully.');
}

*/
public function destroy($id)
{
// Ensure only an admin can perform this action
$admin = auth()->user();
if ($admin->role_id != 1) {
    abort(403, 'Unauthorized action.');
}

// Find the member by ID and delete
$member = User::findOrFail($id);
$member->delete();

// Redirect back to the members list with a success message
return redirect()->route('admin.viewMembers')->with('success', 'Member deleted successfully.');
}

public function showMessageForm($id)
{
// Retrieve the member information based on ID
$member = User::findOrFail($id);

// Pass the member data to the view
return view('backend.admin.send-sms', compact('member'));
}

public function sendSMS(Request $request, $id)
{
// Retrieve the member information based on ID
$member = User::findOrFail($id);

// Get the message from the form input
$message = $request->message;

// Send SMS via BulkSMSBD API
$response = $this->sms_send($member->mobile_number, $message);

// Log the response (You can store it in the database or check for success/failure)
\Log::info("Response from BulkSMSBD API: {$response}");

// Redirect back to the members page with a success message
return redirect()->route('admin.viewMembers')->with('success', 'SMS sent successfully!');
}


/*
// Bulk SMS send function
private function sms_send($number, $message)
{
// Define the API URL
$url = "http://bulksmsbd.net/api/smsapi";

// Replace these with your actual API key and sender ID
$api_key = "c0kGJBawNsKzQa6vsoSF";  // Add your actual API key here
$senderid = "POJ CLUB";  // Add your sender ID here

// Prepare the data for the request
$data = [
    "api_key" => $api_key,
    "senderid" => $senderid,
    "number" => $number,
    "message" => $message
];

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Correctly format the data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute the request and capture the response
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Return the response
return $response;
}
*/


private function sms_send($number, $message)
{
    $api_key = "c0kGJBawNsKzQa6vsoSF";  // Add your actual API key here
    $senderid = "POJ CLUB";  // Add your sender ID here
    $url = "http://bulksmsbd.net/api/smsapi";

    // Use Laravel's HTTP Client (Guzzle)
    $response = Http::asForm()->post($url, [
        'api_key' => $api_key,
        'senderid' => $senderid,
        'number' => $number,
        'message' => $message,
    ]);

    // Return the response
    return $response->body();
}

}
