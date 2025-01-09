<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Xenon\LaravelBDSms\Facades\SMS;
use Xenon\LaravelBDSms\Provider\BulkSmsBD;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Contact;
use App\Mail\ResetPasswordMail; // Assuming you have this Mail class
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;
use App\Models\Payment;
use Karim007\SslCommerz\SslCommerz;
use Karim007\SslcommerzLaravel\Facade\SSLCommerzPayment;
use App\Http\Controllers\SslCommerzPaymentController;
use Karim007\SslcommerzLaravel\SslCommerz\SslCommerzNotification;
use App\Models\Order;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('frontend.registration');
    }

    /*
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

*/

public function register(array $data)
{
    try {
        // Log incoming data for debugging
        Log::info('Registration data: ', $data);

        // Validate the data
        $validated = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bangla_name' => 'nullable|string|max:255',
            'photo' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|digits:11|unique:users,mobile_number',
            'dob' => 'required|date',
            'nid' => 'required|string|max:255|unique:users,nid',
            'gender' => 'required|in:Male,Female,Other',
            'blood_group' => 'required|in:A+,B+,O+,AB+,A-,B-,O-,AB-',
            'education' => 'required|in:high_school,bachelor,master,phd',
            'profession' => 'required|string|max:255',
            'skills' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'thana' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'membership_type' => 'required|in:basic,premium,VIP',
            // Removed registration_fee and terms validation
        ]);

        // Handle validation failure
        if ($validated->fails()) {
            Log::error('Validation failed: ', $validated->errors()->toArray());
            throw new \Exception('Validation errors: ' . implode(', ', $validated->errors()->all()));
        }

        $validatedData = $validated->validated();

        // Retrieve the registration fee (amount) from the orders table
        $order = Order::where('user_id', auth()->id())
                     ->orderBy('created_at', 'desc')
                     ->first();

        // Log order details
        if ($order) {
            Log::info('Order found: ', ['order_amount' => $order->amount]);
        } else {
            Log::error('No order found for the user.');
            throw new \Exception('No order found to retrieve the registration fee.');
        }

        // Get the amount from the order and store it in the registration_fee column
        $registrationFee = $order->amount;

        // Generate a random password
        $randomPassword = Str::random(12);
        Log::info("Generated password: " . $randomPassword);

        // Create the user
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'bangla_name' => $validatedData['bangla_name'] ?? '',
            'photo' => $validatedData['photo'] ?? null,
            'email' => $validatedData['email'],
            'mobile_number' => $validatedData['mobile_number'],
            'dob' => $validatedData['dob'],
            'nid' => $validatedData['nid'],
            'gender' => $validatedData['gender'],
            'blood_group' => $validatedData['blood_group'],
            'education' => $validatedData['education'],
            'profession' => $validatedData['profession'],
            'skills' => $validatedData['skills'] ?? '',
            'country' => $validatedData['country'],
            'division' => $validatedData['division'],
            'district' => $validatedData['district'],
            'thana' => $validatedData['thana'],
            'address' => $validatedData['address'],
            'membership_type' => $validatedData['membership_type'],
            'registration_fee' => $registrationFee, // Store the registration fee
            'password' => Hash::make($randomPassword),
            'terms' => 'accepted', // Set terms to "accepted"
            'role_id' => 3, // Default user role
        ]);

        // Log the created user details
        Log::info("User created successfully: ", ['user_id' => $user->id, 'email' => $user->email]);

        // Mark email as verified
        $user->email_verified_at = now();
        $user->remember_token = Str::random(60);
        $user->save();

        // Send password to the user via SMS
        Log::info("Sending SMS to user with number: {$user->mobile_number}");
        $this->sendPasswordSMS($user->mobile_number, $randomPassword);

        // Send password via email as well
        Log::info("Sending email to user with email: {$user->email}");
        $this->sendPasswordEmail($user, $randomPassword);

        // Redirect to the success page after registration
        Log::info("Redirecting to success page.");
        return redirect()->route('register.success');
        
    } catch (\Exception $e) {
        // Log error and throw exception
        Log::error('User registration failed: ' . $e->getMessage());
        throw new \Exception('Registration failed: ' . $e->getMessage());
    }


    
}





    


    private function sendPasswordEmail($user, $password)
    {
        try {
            Mail::send('frontend.registration-password', ['user' => $user, 'password' => $password], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your Registration Password')
                        ->from(env('MAIL_FROM_ADDRESS', 'default@example.com'), env('MAIL_FROM_NAME', 'Your Company Name'));
            });
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }

    public function sendPasswordSMS($number, $password)
    {
        $countryCode = '+880'; // Set your country code here
        $formattedNumber = $countryCode . ltrim($number, '0'); // Add country code and remove leading zero if present
        
        // Log the formatted phone number
        Log::info("Formatted phone number: {$formattedNumber}");
        
        $message = "Hello, your registration is complete. Your password is: {$password}.";
        
        // Log the message being sent
        Log::info("Sending SMS message: {$message}");
        
        try {
            // Log before making the SMS API request
            Log::info("Attempting to send SMS via BulkSMSBD API.");
            
            // Send SMS via BulkSMSBD
            $response = SMS::shoot($formattedNumber, $message);
            
            // Log the raw response from the SMS API
            Log::info("Raw response from BulkSMSBD: " . print_r($response, true));
            
            // Decode the response
            if (is_string($response)) {
                $response = json_decode($response, true);
                Log::info("Decoded response: " . print_r($response, true));
            }

            // Decode the nested response if present
            $nestedResponse = isset($response['response']) ? json_decode($response['response'], true) : [];

            // Log the decoded nested response
            Log::info("Decoded nested response: " . print_r($nestedResponse, true));

            // Check for success (response code 202)
            if (isset($nestedResponse['response_code']) && $nestedResponse['response_code'] == 202) {
                Log::info("SMS sent successfully to {$formattedNumber}. Message ID: " . ($nestedResponse['message_id'] ?? 'Unknown'));
                return true; // Success
            }

            // Log any errors if the response code is not 202
            $errorMessage = $nestedResponse['error_message'] ?? 'Unknown error';
            Log::error("Failed to send SMS to {$formattedNumber}. Error: {$errorMessage}");
            return false; // Failure
        } catch (\Exception $e) {
            // Catch any exceptions and log the error
            Log::error("Error sending SMS to {$formattedNumber}: " . $e->getMessage());
            return false; // Failure
        }
    }



    public function success()
    {
        return view('frontend.registration-success');
    }






  public function checkUnique(Request $request)
{
    $errors = [];

    // Check for email
    if (User::where('email', $request->email)->exists()) {
        $errors['email'] = 'This email is already taken.';
    }

    // Check for mobile number
    if (User::where('mobile_number', $request->mobile_number)->exists()) {
        $errors['mobile_number'] = 'This mobile number is already taken.';
    }

    // Check for NID
    if (User::where('nid', $request->nid)->exists()) {
        $errors['nid'] = 'This NID is already taken.';
    }

    // Return response
    if (count($errors) > 0) {
        return response()->json(['success' => false, 'errors' => $errors]);
    }

    return response()->json(['success' => true]);
}










}
