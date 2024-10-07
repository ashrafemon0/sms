<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\DB;

class SslCommerzPaymentController extends Controller
{

    public function initiatePayment(Request $request)
    {
        $storeID = env('SSCOMMERZ_STORE_ID');
        $storePassword = env('SSCOMMERZ_STORE_PASSWORD');

        // Find the payment record
        $payment = Payment::find($request->payment_id);

        if (!$payment) {
            return redirect()->back()->with('error', 'Payment record not found.');
        }

        // Generate a unique 'tran_id' if it's null
        if (is_null($payment->tran_id)) {
            $payment->tran_id = uniqid('tran_', true);
            $payment->status = 'Pending';  // Set status to 'Pending'
            $payment->save();
        }

        $post_data = [
            'total_amount' => $payment->amount + $payment->late_fee,  // Ensure the total amount includes the late fee
            'currency' => "BDT",
            'tran_id' => $payment->tran_id,
            'success_url' => route('payment.success'),  // Now you can use route() here
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'cus_name' => $request->student_id,
            'cus_email' => 'customer@example.com',
            'cus_phone' => '01711111111',
            'cus_add1' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_country' => 'Bangladesh',
            'shipping_method' => 'NO',
            'product_name' => 'Tuition Fee Payment',
            'product_category' => 'Education',
            'product_profile' => 'general',
        ];

        $sslc = new SslCommerzNotification();

        // Initiate payment with SSLCommerz
        $payment_options = $sslc->makePayment($post_data, 'hosted', $storeID, $storePassword);

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }
    }





    public function success(Request $request)
    {
        $payment = Payment::where('tran_id', $request->tran_id)->first();
        if ($payment) {
            $payment->status = 'Paid';  // Mark the payment as successful
            $payment->save();
        }

        return view('admin.backend.payment.success', ['payment' => $payment]);
    }

    public function fail(Request $request)
    {
        // Mark the payment as failed
        $payment = Payment::where('tran_id', $request->tran_id)->first();
        $payment->payment_status = 'failed';
        $payment->save();

        return view('admin.backend.payment.fail', compact('payment'));
    }

    public function cancel(Request $request)
    {
        // Mark the payment as canceled
        $payment = Payment::where('tran_id', $request->tran_id)->first();
        $payment->payment_status = 'canceled';
        $payment->save();

        return view('admin.backend.payment.cancel', compact('payment'));
    }
}
