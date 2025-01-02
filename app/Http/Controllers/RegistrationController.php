<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;  // To generate a random password
use Illuminate\Support\Facades\Mail;  // For sending the random password via email
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
// Show the registration form
public function showForm()
{
    return view('frontend.registration'); // Return the registration view
}

public function register(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'bangla_name' => 'required|string|max:255',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'required|email|unique:users,email',
        'mobile_number' => 'required|digits:11',
        'dob' => 'required|date',
        'nid' => 'required|string|max:255',
        'gender' => 'required|in:Male,Female,Other',
        'blood_group' => 'required|in:A+,B+,O+,AB+,A-,B-,O-,AB-',
        'education' => 'required|in:high_school,bachelor,master,phd',
        'profession' => 'required|string|max:255',
        'skills' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed', // Password is nullable, as we will generate a random one
        'terms' => 'accepted',
        'country' => 'required|string|max:255',
        'division' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'thana' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'membership_type' => 'required|in:basic,premium,VIP',
    ]);
    
    // Determine registration fee based on membership type
    $registrationFee = 0;
    switch ($request->membership_type) {
        case 'basic':
            $registrationFee = 100;
            break;
        case 'premium':
            $registrationFee = 200;
            break;
        case 'VIP':
            $registrationFee = 400;
            break;
    }
//Photo Uploading
    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $timestamp = time(); // Generate a timestamp
        $photoName = $request->first_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension(); // Combine first name and timestamp
        $photoPath = $request->file('photo')->move(public_path('profilepics'), $photoName); // Save the file in the profilepics folder
    } else {
        return back()->withErrors(['photo' => 'No valid photo uploaded.']);
    }
    

    // Generate a random password if not provided
    $randomPassword = Str::random(12);  // Generate a random 12-character password

    try {
        // Create the user with all validated data, including registration fee
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bangla_name' => $request->bangla_name,
            'photo' => $photoPath,  // Store the file path
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'dob' => $request->dob,
            'nid' => $request->nid,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'education' => $request->education,
            'profession' => $request->profession,
            'skills' => $request->skills,
            'country' => $request->country,  // New field
            'division' => $request->division,  // New field
            'district' => $request->district,  // New field
            'thana' => $request->thana,  // New field
            'address' => $request->address,  // New field
            'membership_type' => $request->membership_type,  // New field
            'registration_fee' => $registrationFee,  // Save the registration fee
            'password' => Hash::make($randomPassword), // Hash the random password
            'role_id' => 3,  // Default role_id set to 3 (User role)
            'terms' => 'accepted',
        ]);
    
        // Manually set the email_verified_at field
        $user->email_verified_at = now();
    
        // Generate and set the remember_token after user creation
        $user->update(['remember_token' => Str::random(60)]);
    
        // Save the user with the updated remember_token
        $user->save();
        $this->sendPasswordSMS($user->mobile_number, $randomPassword);

        // Send the password to the user via email
        $this->sendPasswordEmail($user, $randomPassword);
    
        // Redirect to the success page
        return redirect()->route('register.success');
    } catch (\Exception $e) {
        // Handle errors
        Log::error('User registration failed: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Registration failed, please try again.']);
    }
}



private function sendPasswordEmail($user, $password)
{
    try {
        // Debug: Check the email configuration
        Log::info('From email: ' . env('MAIL_FROM_ADDRESS'));

        // Send email using Mail::send and passing the data to the view
        Mail::send('frontend.registration-password', ['user' => $user, 'password' => $password], function ($message) use ($user) {
            // Setting the email properties
            $message->to($user->email)
                    ->subject('Your Registration Password')
                    ->from(env('MAIL_FROM_ADDRESS', 'default@example.com'), env('MAIL_FROM_NAME', 'Your Company Name')); // Using env with fallback
        });

        Log::info('Email sent successfully to ' . $user->email);
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error('Error sending email: ' . $e->getMessage());
    }
}

/*
private function sendPasswordEmail($user, $password)
{
try {
    // Email body content
    $emailBody = "Hello {$user->first_name},\n\nYour login credentials are as follows:\nEmail: {$user->email}\nPassword: {$password}\n\nThank you for registering with us.";

    // Send email using the Mail facade
    $result = Mail::raw($emailBody, function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Your Login Information');
    });

    Log::info('Email sent successfully to ' . $user->email);
} catch (\Exception $e) {
    Log::error('Error sending email: ' . $e->getMessage());
    // Log the result if available
    Log::error('Mail result: ' . json_encode($result ?? 'No result'));
}
}
*/


private function sendPasswordSMS($number, $password)
{
    $message = "Hello, your registration is complete. Your login password is: {$password}.";
    
    // Call SMS API
    $response = $this->sms_send($number, $message);
    
    // Log the response from the SMS API
    Log::info('SMS sent successfully to ' . $number . '. Response: ' . $response);
}





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








// Show the registration success page
public function success()
{
    return view('frontend.registration-success');  // Return the success view
}


}
