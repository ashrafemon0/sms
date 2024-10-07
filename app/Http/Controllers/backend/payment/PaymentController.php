<?php

namespace App\Http\Controllers\backend\payment;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\Payment;
use App\Models\PromoCode;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeCategoryAmount;
use App\Models\StudentPayment;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function TuitionFeePaySlip(Request $request, $class_id, $student_id)
    {
        // Fetch the student's data
        $student = StudentData::where('student_id', $student_id)->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Get the selected months
        $selectedMonths = $request->input('months');

        // Check if any of the selected months have already been paid
        $existingPayments = Payment::where('student_id', $student->id)
            ->where(function ($query) use ($selectedMonths) {
                foreach ($selectedMonths as $month) {
                    $query->orWhere('months', 'LIKE', "%$month%");
                }
            })
            ->get();

        if ($existingPayments->isNotEmpty()) {
            // Get the names of the months that have already been paid
            $paidMonths = [];
            foreach ($existingPayments as $payment) {
                $paidMonths = array_merge($paidMonths, explode(',', $payment->months));
            }

            // Filter the paid months from the selected months
            $alreadyPaid = array_intersect($paidMonths, $selectedMonths);

            // If any months are already paid, show an error message
            if (!empty($alreadyPaid)) {
                return redirect()->back()->with('error', 'Payment already cleared for the following months: ' . implode(', ', $alreadyPaid));
            }
        }

        // Calculate the total amount with fee amount, discount, and late fee
        $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
            ->where('fee_category_id', 2)
            ->first();

        $totalAmount = $feeAmount->fee_category_amount * count($selectedMonths);
        $promoCode = $request->input('promo_code');
        $discount = 0;
        $lateFee = 0;

        // Apply promo code discount
        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->first();
            if ($promo && $promo->isValid()) {
                $discount = $promo->discount;
                $totalAmount = $totalAmount - ($totalAmount * ($discount / 100));
            }
        }

        // Calculate late fee if payment date is after the 10th
        if (date('d', strtotime($request->input('payment_date'))) > 10) {
            $lateFee = 500; // Late fee of 500 Tk
        }

        // Add late fee to total amount
        $totalAmount += $lateFee;

        // Store the payment data
        Payment::create([
            'student_id' => $student->id,
            'amount' => $totalAmount,
            'months' => implode(',', $selectedMonths), // Store selected months as a comma-separated string
            'late_fee' => $lateFee,
            'discount' => $discount,
            'payment_date' => $request->input('payment_date'),
            'status'=> 'Paid',
        ]);
        $payment = Payment::find($request->payment_id);

        if ($payment) {
            // Update the payment status to "Paid"
            $payment->status = 'Paid'; // You need to add a `status` column in the payments table
            $payment->save();
        }

        // Redirect to a success page or back to the form with success message
        return redirect()->back()->with('success', 'Payment recorded successfully');
    }




}
