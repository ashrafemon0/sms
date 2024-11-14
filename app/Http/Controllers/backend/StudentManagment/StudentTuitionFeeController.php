<?php

namespace App\Http\Controllers\backend\StudentManagment;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Payment;
use App\Models\Payments;
use App\Models\PromoCode;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeCategoryAmount;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class StudentTuitionFeeController extends Controller
{
    public function StudentTuitionFeeView(){

        $user = auth()->user();

        $data['studentClass'] = StudentData::where('student_id', $user->user_id)->pluck('class_id'); // Fetch only the class for the logged-in user
        $data['studentYear'] = StudentData::where('student_id', $user->user_id)->pluck('year_id');
        return view('admin.backend.student.student_tuition_fee.tuition_fee_view',$data);
    }

//    public function TuitionFeeClassWiseGet(Request $request){
//        $year_id = $request->year_id;
//        $class_id = $request->class_id;
//
//        if ($year_id != ''){
//            $where[] = ['year_id','like',$year_id.'%'];
//        }
//        if ($class_id != ''){
//            $where[] = ['class_id','like',$class_id.'%'];
//        }
//        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
////        dd($allStudent->toArray());
//        $html['thsource'] = '<th>SL NO</th>';
//        $html['thsource'] .= '<th>ID NO</th>';
//        $html['thsource'] .= '<th>Student Name</th>';
//        $html['thsource'] .= '<th>Roll No</th>';
//        $html['thsource'] .= '<th>Tuition Fee</th>';
////        $html['thsource'] .= '<th>Discount</th>';
//        $html['thsource'] .= '<th>Student Fee</th>';
//        $html['thsource'] .= '<th>Action</th>';
//
//        foreach ($allStudent as $key => $v){
//            $registrationFee = StudentFeeCategoryAmount::where('fee_category_id','2')->where('class_id',$v->class_id)->first();
////            dd($registrationFee->toArray());
//            $color = 'success';
//            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$registrationFee->fee_category_amount.'</td>';
////            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';
//
//            $originalFee = (float)$registrationFee->fee_category_amount;
//
////            $discount = (float)$v['discount']['discount'];
////            $discountableFee = $discount/100*$originalFee;
////            $finalFee = $originalFee-$discountableFee;
//
//            $html[$key]['tdsource'] .= '<td>'.$originalFee.'Tk'.'</td>';
//            $html[$key]['tdsource'] .='<td>';
//            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank" href="'.route("student.tuition.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'">Fee Slip</a>';
//            $html[$key]['tdsource'] .='</td>';
//        }
//        return response()->json(@$html);
//    }
    public function TuitionFeeClassWiseGet(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;

        // Array to hold filtering conditions
        $where = [];
        if ($year_id != '') {
            $where[] = ['year_id', $year_id];
        }
        if ($class_id != '') {
            $where[] = ['class_id', $class_id];
        }

        // Get the logged-in user's user_id
        $userId = auth()->user()->user_id;

        // Fetch the student data where student_id matches user_id
        $studentData = StudentData::where('student_id', $userId)
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        // Initialize table headers for response
        $html['thsource'] = '<th>SL NO</th>';
        $html['thsource'] .= '<th>Student ID</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Fee Category</th>';
        $html['thsource'] .= '<th>Fee Amount</th>';
        $html['thsource'] .= '<th>Action</th>';

        // Loop through the student data and populate the rows
        foreach ($studentData as $key => $student) {
            // Fetch the fee category amount for the student class
            $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
                ->where('fee_category_id', '2') // Assuming Tuition fee category ID is 2
                ->first();

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $student->student_id . '</td>'; // Student ID
            $html[$key]['tdsource'] .= '<td>' . $student->name . '</td>'; // Student Name
            $html[$key]['tdsource'] .= '<td>Tuition Fee</td>'; // Fee Category (hardcoded here as an example)
            $html[$key]['tdsource'] .= '<td>' . ($feeAmount ? $feeAmount->fee_category_amount : 'N/A') . ' Tk</td>'; // Fee Amount

            // Action button for payment
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blank" href="' . route("student.tuition.fee.payment", ['class_id' => $student->class_id, 'student_id' => $student->student_id]) . '">Pay Now</a>';
            $html[$key]['tdsource'] .= '</td>';
        }


        // Return the student data as a JSON response
        return response()->json($html);
    }



    public function TuitionFeePaySlip(Request $request, $class_id, $student_id)
    {
        // Fetch the student's data
        $student = StudentData::where('student_id', $student_id)->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Fetch fee amount for the specified class and fee category
        $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
            ->where('fee_category_id', 2)
            ->first();

        $promoCode = $request->input('promo_code');
        $selectedMonths = $request->input('months', []); // Array of selected months
        $monthCount = count($selectedMonths); // Number of selected months
        $totalAmount = $feeAmount->fee_category_amount * $monthCount;
        $discount = 0;
        $lateFee = 0;

        // Apply discount if a valid promo code is provided
        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->first();
            if ($promo && $promo->isValid()) {
                $discount = $promo->discount;
                $totalAmount = $totalAmount - ($totalAmount * ($discount / 100));
            }
        }

        // Apply late fee if payment date is after the 10th
        $paymentDate = $request->input('payment_date', date('Y-m-d')); // Use current date if none provided
        if (date('d', strtotime($paymentDate)) > 10) {
            $lateFee = 500;
        }
        $totalAmount += $lateFee;

        // Fetch all payments for the student to display
        $payments = Payments::where('student_id', $student->id)->get();

        // Pass data to the view
        return view('admin.backend.student.student_tuition_fee.pay_now', compact(
            'feeAmount', 'totalAmount', 'discount', 'lateFee', 'monthCount', 'student', 'class_id', 'student_id', 'payments', 'selectedMonths'
        ));
    }







//    public function TuitionFeePaySlip(Request $request){
//        $class_id = $request->class_id;
//        $student_id = $request->student_id;
//        $allStudent['month'] = $request->month;
//
//        $allStudent['details'] = AssignStudent::with(['student'])->where('class_id',$class_id)->where('student_id',$student_id)->first();
////        dd($allStudent['details']->toArray());
//
//        $pdf = PDF::loadView('admin.backend.student.student_tuition_fee.tuitionFeePdf', $allStudent);
//        return $pdf->stream('document.pdf');
//    }
}
