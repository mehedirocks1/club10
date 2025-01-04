<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Karim007\SslcommerzLaravel\Facade\SSLCommerzPayment;
use Karim007\SslcommerzLaravel\SslCommerz\SslCommerzNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SslCommerzPaymentController extends Controller
{
    public function exampleEasyCheckout()
    {
        return view('sslcommerz::exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('sslcommerz::exampleHosted');
    }
/*
    public function index(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = '10'; // You cannot pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        $customer = array();
        $customer['name']   = $request->input('first_name');
        $customer['email'] = $request->input('email');
        $customer['address_1']= $request->input('address');
        $customer['address_2'] = "";
        $customer['city']  = $request->input('district');
        $customer['state'] = "";
        $customer['postcode'] = "";
        $customer['country'] = "Bangladesh";
        $customer['phone'] = '8801XXXXXXXXX';
        $customer['fax'] = "";

        $s_info = array();
        $s_info['shipping_method'] = 'Yes'; // Shipping method (YES/NO)
        $s_info['num_of_item'] = 1; // Number of items
        $s_info['ship_name'] = 'Abc'; // Shipping name
        $s_info['ship_add1'] = 'Dhaka'; // Shipping address
        $s_info['ship_add2'] = '';
        $s_info['ship_city'] = 'Dhaka'; // Shipping city
        $s_info['ship_state'] = '';
        $s_info['ship_postcode'] = '1215'; // Shipping postcode
        $s_info['ship_country'] = 'Bangladesh'; // Shipping country

        $sslc = new SslCommerzNotification();
        $sslc->setCustomerInfo($customer)->setShipmentInfo($s_info);

        // Insert or update order status as Pending
        DB::table('orders')
            ->updateOrInsert([
                'transaction_id' => $post_data['tran_id']
            ], [
                'name' => $post_data['name'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'currency' => $post_data['currency']
            ]);

        // Initiate payment (false: redirect to gateway / true: show payment options)
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        return $payment_options;
    }

*/

public function index(Request $request)
{
    {
        $post_data = array();
        //$post_data['total_amount'] = '10'; // You cannot pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique
    
        // Membership Fee Calculation
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
    
        $post_data['total_amount'] = $registrationFee + $request->amount; // Ad
    
        // Customer data
        $post_data['customer'] = array();
        $post_data['customer']['first_name'] = $request->input('first_name');
        $post_data['customer']['last_name'] = $request->input('last_name');
        $post_data['customer']['bangla_name'] = $request->input('bangla_name');
        
    
        // If photo is a file, handle it
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_path = $photo->store('photos', 'public'); // Store photo and get the path
            $post_data['customer']['photo'] = $photo_path;
        } else {
            $post_data['customer']['photo'] = $request->input('photo'); // If it's just a URL or existing path
        }
    
        $post_data['customer']['email'] = $request->input('email');
        $post_data['customer']['education'] = $request->input('education');
        $post_data['customer']['mobile_number'] = $request->input('mobile_number');
        $post_data['customer']['blood_group'] = $request->input('blood_group');
        $post_data['customer']['dob'] = $request->input('dob');
        $post_data['customer']['nid'] = $request->input('nid');
        $post_data['customer']['gender'] = $request->input('gender');
        $post_data['customer']['profession'] = $request->input('profession');
        $post_data['customer']['skills'] = $request->input('skills');
        $post_data['customer']['password'] = bcrypt($request->input('password')); // Ensure password is hashed
        $post_data['customer']['terms'] = $request->input('terms'); // Assuming this is a boolean or 'accepted'
        $post_data['customer']['country'] = $request->input('country');
        $post_data['customer']['division'] = $request->input('division');
        $post_data['customer']['district'] = $request->input('district');
        $post_data['customer']['thana'] = $request->input('thana');
        $post_data['customer']['address'] = $request->input('address');
        $post_data['customer']['membership_type'] = $request->input('membership_type');
    
        // Shipping information
        $post_data['shipping_info'] = array();
        $post_data['shipping_info']['shipping_method'] = 'Yes'; // Shipping method (YES/NO)
        $post_data['shipping_info']['num_of_item'] = 1; // Number of items
        $post_data['shipping_info']['ship_name'] = 'Abc'; // Shipping name
        $post_data['shipping_info']['ship_add1'] = 'Dhaka'; // Shipping address
        $post_data['shipping_info']['ship_add2'] = '';
        $post_data['shipping_info']['ship_city'] = 'Dhaka'; // Shipping city
        $post_data['shipping_info']['ship_state'] = '';
        $post_data['shipping_info']['ship_postcode'] = '1215'; // Shipping postcode
        $post_data['shipping_info']['ship_country'] = 'Bangladesh'; // Shipping country
    
        // SSLCommerz notification instance
        $sslc = new SslCommerzNotification();
        $sslc->setCustomerInfo($post_data['customer'])->setShipmentInfo($post_data['shipping_info']);
    
        // Insert or update order status as Pending
        DB::table('orders')
            ->updateOrInsert(
                ['transaction_id' => $post_data['tran_id']], // Match condition (using the transaction ID)
                [
                    'name' => $post_data['customer']['first_name'] . ' ' . $post_data['customer']['last_name'],
                    'email' => $post_data['customer']['email'],
                    'phone' => $post_data['customer']['mobile_number'],
                    'amount' => $post_data['total_amount'],
                    'address' => $post_data['customer']['address'],
                    'status' => 'Pending',
                    'currency' => $post_data['currency'],
                    'first_name' => $post_data['customer']['first_name'],
                    'last_name' => $post_data['customer']['last_name'],
                    'bangla_name' => $post_data['customer']['bangla_name'],
                    'photo' => $post_data['customer']['photo'], // Store the photo path if it's uploaded
                    'mobile_number' => $post_data['customer']['mobile_number'],
                    'dob' => $post_data['customer']['dob'],
                    'nid' => $post_data['customer']['nid'],
                    'gender' => $post_data['customer']['gender'],
                    'blood_group' => $post_data['customer']['blood_group'],
                    'education' => $post_data['customer']['education'],
                    'profession' => $post_data['customer']['profession'],
                    'skills' => $post_data['customer']['skills'],
                    'password' => $post_data['customer']['password'], // Already hashed
                    'country' => $post_data['customer']['country'],
                    'division' => $post_data['customer']['division'],
                    'district' => $post_data['customer']['district'],
                    'thana' => $post_data['customer']['thana'],
                    'membership_type' => $post_data['customer']['membership_type'],
                ]
            );
    }

    
    // Initiate payment (false: redirect to gateway / true: show payment options)
    $payment_options = $sslc->makePayment($post_data, 'hosted');
    return $payment_options;
}











    public function payViaAjax(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = '10'; // You cannot pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        $customer = array();
        $customer['name'] = 'Ab Karim';
        $customer['email'] = 'customer@mail.com';
        $customer['address_1'] = 'Dhaka';
        $customer['address_2'] = "";
        $customer['city'] = "";
        $customer['state'] = "";
        $customer['postcode'] = "";
        $customer['country'] = "Bangladesh";
        $customer['phone'] = '8801XXXXXXXXX';
        $customer['fax'] = "";

        $s_info = array();
        $s_info['shipping_method'] = 'Yes'; // Shipping method (YES/NO)
        $s_info['num_of_item'] = 1; // Number of items
        $s_info['ship_name'] = 'Abc'; // Shipping name
        $s_info['ship_add1'] = 'Dhaka'; // Shipping address
        $s_info['ship_add2'] = '';
        $s_info['ship_city'] = 'Dhaka'; // Shipping city
        $s_info['ship_state'] = '';
        $s_info['ship_postcode'] = '1215'; // Shipping postcode
        $s_info['ship_country'] = 'Bangladesh'; // Shipping country

        $sslc = new SslCommerzNotification();
        $sslc->setCustomerInfo($customer)->setShipmentInfo($s_info);

        // Insert or update order status as Pending
        DB::table('orders')
            ->updateOrInsert([
                'transaction_id' => $post_data['tran_id']
            ], [
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'currency' => $post_data['currency']
            ]);

        // Initiate payment (false: redirect to gateway / true: show payment options)
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        return $payment_options;
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        // Check order status in order table against the transaction id or order id.
        $order_details = $this->findOrder($tran_id);
        if ($order_details->status == 'Pending') {
            $validation = SSLCommerzPayment::orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                $this->orderUpdate($tran_id, 'Processing');
                return SSLCommerzPayment::returnSuccess($tran_id, "Transaction is successfully Completed", '/');
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return SSLCommerzPayment::returnSuccess($tran_id, "Transaction is successfully Completed", '/');
        }

        // Something went wrong, redirect customer to product page
        return SSLCommerzPayment::returnFail($tran_id, "Invalid Transaction", '/');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_details = $this->findOrder($tran_id);
        if ($order_details->status == 'Pending') {
            $this->orderUpdate($tran_id, 'Failed');
            return SSLCommerzPayment::returnFail($tran_id, "Transaction is Failed", '/');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return SSLCommerzPayment::returnSuccess($tran_id, "Transaction is already Successful", '/');
        } else {
            return SSLCommerzPayment::returnFail($tran_id, "Transaction is Invalid", '/');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = $this->findOrder($tran_id);
        if ($order_details->status == 'Pending') {
            $this->orderUpdate($tran_id, 'Canceled');
            return SSLCommerzPayment::returnFail($tran_id, "Transaction is Cancelled", '/');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return SSLCommerzPayment::returnSuccess($tran_id, "Transaction is already Successful", '/');
        } else {
            return SSLCommerzPayment::returnFail($tran_id, "Transaction is Invalid", '/');
        }
    }

    public function ipn(Request $request)
    {
        // Receive all the payment information from the gateway
        if ($request->input('tran_id')) { // Check if transaction id is posted
            $tran_id = $request->input('tran_id');

            // Check order status in order table against the transaction id or order id
            $order_details = $this->findOrder($tran_id);
            if ($order_details->status == 'Pending') {
                // Validate the order
                $validation = SSLCommerzPayment::orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    $this->orderUpdate($tran_id, 'Processing');
                    return SSLCommerzPayment::returnSuccess($tran_id, "Transaction is successfully Completed", '/');
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                return SSLCommerzPayment::returnSuccess($tran_id, "Transaction is already successfully Completed", '/');
            } else {
                // Something went wrong, redirect customer to product page
                return SSLCommerzPayment::returnFail($tran_id, "Invalid Transaction", '/');
            }
        }
        return SSLCommerzPayment::returnFail('', "Invalid Data", '/');
    }

    private function orderUpdate($tran_id, $status)
    {
        DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->update(['status' => $status]);
    }

    private function findOrder($tran_id)
    {
        return DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')
            ->first();
    }
}
