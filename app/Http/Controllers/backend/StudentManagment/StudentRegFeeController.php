<?php

namespace App\Http\Controllers\backend\StudentManagment;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Payment;
use App\Models\Payments;
use App\Models\PromoCode;
use App\Models\RegPayment;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentFeeCategoryAmount;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class StudentRegFeeController extends Controller
{
    public function StudentRegFeeView(){
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        return view('admin.backend.student.student_reg_fee.registration_fee_view',$data);
    }

//    public function RegFeeClassWiseGet(Request $request){
//        $year_id = $request->year_id;
//        $class_id = $request->class_id;
//
//        // Initialize conditions for querying based on selected year and class
//        $where = [];
//        if ($year_id != '') {
//            $where[] = ['year_id', $year_id];
//        }
//        if ($class_id != '') {
//            $where[] = ['class_id', $class_id];
//        }
//
//        // Fetch students based on the year and class along with their associated data
//        $allStudent = AssignStudent::with(['studentData']) // Ensure studentData is a proper relation
//        ->where($where)
//            ->get();
//
//        // Prepare the table header
//        $html['thsource'] = '<th>SL NO</th>';
//        $html['thsource'] .= '<th>Student ID</th>';
//        $html['thsource'] .= '<th>Student Name</th>';
//        $html['thsource'] .= '<th>Roll No</th>';
//        $html['thsource'] .= '<th>Reg Fee</th>';
////        $html['thsource'] .= '<th>Discount</th>';
////        $html['thsource'] .= '<th>Student Fee</th>';
//        $html['thsource'] .= '<th>Action</th>';
//
//        // Populate the table data for each student
//        foreach ($allStudent as $key => $v) {
//            $registrationFee = StudentFeeCategoryAmount::where('fee_category_id', '1')
//                ->where('class_id', $v->class_id)
//                ->first();
//
//            $color = 'success';
//            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['student_id'].'</td>'; // Use studentData relation
//            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['name'].'</td>'; // Use studentData relation
//            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$registrationFee->fee_category_amount.'</td>';
////            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%</td>';
//
//            // Calculate the final fee after discount
////            $originalFee = (float) $registrationFee->fee_category_amount;
////            $discount = (float) $v['discount']['discount'];
////            $discountableFee = $discount / 100 * $originalFee;
////            $finalFee = $originalFee - $discountableFee;
////
////            $html[$key]['tdsource'] .= '<td>'.$finalFee.'Tk</td>';
//            $html[$key]['tdsource'] .= '<td>';
//            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
//            $html[$key]['tdsource'] .= '</td>';
//        }
//
//        return response()->json($html);
//    }

    public function RegFeeClassWiseGet(Request $request) {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $where = [];
        if ($year_id != '') {
            $where[] = ['year_id', $year_id];
        }
        if ($class_id != '') {
            $where[] = ['class_id', $class_id];
        }

        // Fetch students based on year and class
        $allStudents = StudentData::where($where)->get();

        $html['thsource'] = '<th>SL NO</th>';
        $html['thsource'] .= '<th>Student ID</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Fee Category</th>';
        $html['thsource'] .= '<th>Fee Amount</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudents as $key => $student) {
            // Fetch fee category amount for the student class
            $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
                ->where('fee_category_id', '1') // Assuming registration fee category ID is 1
                ->first();

            $html[$key]['tdsource'] = '<td>'.($key + 1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student->student_id.'</td>'; // Student ID
            $html[$key]['tdsource'] .= '<td>'.$student->name.'</td>'; // Student Name
            $html[$key]['tdsource'] .= '<td>Registration Fee</td>'; // Fee Category (hardcoded here as an example)
            $html[$key]['tdsource'] .= '<td>'.$feeAmount->fee_category_amount.' Tk</td>'; // Fee Amount

            // Action button for payment
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blank" href="'.route("student.registration.fee.payment", ['class_id' => $student->class_id, 'student_id' => $student->student_id]).'">Pay Now</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json($html);
    }

    public function showPaymentPage($class_id, $student_id, Request $request)
    {
        $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
            ->where('fee_category_id', 1) // Assuming fee_category_id = 1 is for registration fees
            ->first();

        // Fetch the student's data
        $student = StudentData::where('student_id', $student_id)->first();

        // Check if student exists
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Calculate the total amount
        $totalAmount = $feeAmount ? $feeAmount->fee_category_amount : 0;

        // Handle promo code (if provided)
        $promoCode = $request->input('promo_code');
        $discount = 0;

        // Check if the promo code is valid
        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->first();
            if ($promo && $promo->isValid()) {
                $discount = $promo->discount; // Assume this is already a decimal value
                $totalAmount = $totalAmount - ($totalAmount * ($discount / 100)); // Update total amount with discount
            }
        }

        // Fetch previous payments for this student
        $payments = Payments::where('student_id', $student->id)->get();

        // Pass data to the view
        return view('admin.backend.student.student_reg_fee.payment_page', compact('feeAmount', 'totalAmount', 'discount', 'student', 'payments', 'class_id', 'student_id'));
    }





//    public function RegFeePaySlip(Request $request){
//        $class_id = $request->class_id;
//        $student_id = $request->student_id;
//
//        $allStudent['details'] = AssignStudent::with(['student'],['discount'])->where('class_id',$class_id)->where('student_id',$student_id)->first();
////        dd($allStudent['details']->toArray());
//
//        $pdf = PDF::loadView('admin.backend.student.student_reg_fee.RegFeePdf', $allStudent);
//        return $pdf->stream('document.pdf');
//    }
}
