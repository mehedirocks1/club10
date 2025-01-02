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
//use SslCommerzNotification;
use App\Http\Controllers\SslCommerzPaymentController;


class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('frontend.registration');
    }

    
    public function register(Request $request)
    {
        Log::info('Registration started for user: ' . $request->email);
    
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
            'password' => 'nullable|string|min:8|confirmed',
            'terms' => 'accepted',
            'country' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'thana' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'membership_type' => 'required|in:basic,premium,VIP',
        ]);
    
        Log::info('User validated successfully.');
    
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
    
        Log::info('Registration fee determined: ' . $registrationFee);
    
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $timestamp = time();
            $photoName = $request->first_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension();
            $photoPath = $request->file('photo')->move(public_path('profilepics'), $photoName);
            Log::info('Photo uploaded: ' . $photoName);
        } else {
            Log::error('No valid photo uploaded.');
            return back()->withErrors(['photo' => 'No valid photo uploaded.']);
        }
    
        $randomPassword = Str::random(12);
        Log::info('Generated random password for user.');
    
        try {
            // Create user data
            $user = DB::table('users')->insertGetId([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'bangla_name' => $request->bangla_name,
                'photo' => $photoPath,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'dob' => $request->dob,
                'nid' => $request->nid,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'education' => $request->education,
                'profession' => $request->profession,
                'skills' => $request->skills,
                'country' => $request->country,
                'division' => $request->division,
                'district' => $request->district,
                'thana' => $request->thana,
                'address' => $request->address,
                'membership_type' => $request->membership_type,
                'registration_fee' => $registrationFee,
                'password' => Hash::make($randomPassword),
                'role_id' => 3,  // Assuming role '3' for the user
                'terms' => 'accepted',
            ]);
    
            Log::info('User created successfully with ID: ' . $user);
    
            // Create order record in 'orders' table
            $transactionId = uniqid();
            DB::table('orders')->insert([
                'user_id' => $user,
                'amount' => $registrationFee,
                'status' => 'Pending',
                'transaction_id' => $transactionId,
                'currency' => 'BDT',
            ]);
    
            Log::info('Order created successfully with transaction ID: ' . $transactionId);
    
            // SSLCommerz payment request data
            $sslcommerz_data = [
                'total_amount' => $registrationFee,
                'currency' => 'BDT',
                'tran_id' => $transactionId,
                'cus_name' => $request->first_name . ' ' . $request->last_name,
                'cus_email' => $request->email,
                'cus_phone' => $request->mobile_number,
                'cus_add1' => $request->address,
                'success_url' => route('sslcommerz.success'),
                'fail_url' => route('sslcommerz.fail'),
                'cancel_url' => route('sslcommerz.cancel'),
                'emi_option' => 0,
            ];
    
            // Initialize SSLCommerz
            $sslCommerz = new SslCommerzNotification();
            Log::info('SSLCommerz payment request data prepared.');
    
            // Make the payment request to SSLCommerz
            $response = $sslCommerz->makePayment($sslcommerz_data, 'hosted');
    
            if ($response) {
                Log::info('Payment request successful.');
                return $response;
            } else {
                Log::error('Unable to process payment.');
                return back()->withErrors(['payment_error' => 'Unable to process payment.']);
            }
        } catch (\Exception $e) {
            Log::error('User registration failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed, please try again.']);
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
}
