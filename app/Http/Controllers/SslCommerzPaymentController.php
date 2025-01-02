<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Karim007\SslcommerzLaravel\Facade\SSLCommerzPayment;


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

    public function index(Request $request)
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
