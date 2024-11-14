<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SslCommerzPaymentController extends Controller
{

    public function initiatePayment(Request $request)
    {
        $storeID = env('SSCOMMERZ_STORE_ID');
        $storePassword = env('SSCOMMERZ_STORE_PASSWORD');

        // Find the payment record
        $payment = Payments::find($request->payment_id);


        if (!$payment) {
            return redirect()->back()->with('error', 'Payment record not found.');
        }

        // Store the logged-in user ID
        $payment->user_id = Auth::id(); // Assuming `user_id` is a field in the `payments` table

        // Generate a unique 'tran_id' if it's null
        if (is_null($payment->tran_id)) {
            $payment->tran_id = uniqid('tran_', true);
            $payment->status = 'Pending';
            $payment->save();
        }

        $post_data = [
            'total_amount' => $payment->amount + $payment->late_fee,
            'currency' => "BDT",
            'tran_id' => $payment->tran_id,
            'success_url' => route('payment.success', [], true),
            'failed_url' => route('payment.fail', [], true),
            'cancel_url' => route('payment.cancel', [], true),
            'cus_name' => Auth::user()->name, // Replace with actual user name if available
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
        $tranId = $request->tran_id;

        // Retrieve the payment record
        $payment = Payments::where('tran_id', $tranId)->first();

        if ($payment) {
            // Retrieve the user associated with this payment
            $user = User::find($payment->user_id);

            if ($user) {
                Auth::login($user);  // Log the user back in after payment is successful
            }

            // Update the payment status to 'Paid'
            $payment->status = 'Paid';
            $payment->save();

            // Pass the payment and user data to the view
            return view('admin.backend.payment.success', [
                'payment' => $payment,
                'user' => $user,
            ]);
        } else {
            // Handle error if payment or user not found
            return redirect()->back()->with('error', 'Payment or user not found.');
        }
    }






    public function fail(Request $request)
    {
        // Mark the payment as failed
        $payment = Payments::where('tran_id', $request->tran_id)->first();
        $payment->payment_status = 'failed';
        $payment->save();

        return view('admin.backend.payment.fail', compact('payment'));
    }

    public function cancel(Request $request)
    {
        // Mark the payment as canceled
        $payment = Payments::where('tran_id', $request->tran_id)->first();
        $payment->payment_status = 'canceled';
        $payment->save();

        return view('admin.backend.payment.cancel', compact('payment'));
    }
}
