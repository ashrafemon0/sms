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
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
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
    public function TuitionFeeClassWiseGet(Request $request) {
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
                ->where('fee_category_id', '2') // Assuming registration fee category ID is 1
                ->first();

            $html[$key]['tdsource'] = '<td>'.($key + 1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student->student_id.'</td>'; // Student ID
            $html[$key]['tdsource'] .= '<td>'.$student->name.'</td>'; // Student Name
            $html[$key]['tdsource'] .= '<td>Tuition Fee</td>'; // Fee Category (hardcoded here as an example)
            $html[$key]['tdsource'] .= '<td>'.$feeAmount->fee_category_amount.' Tk</td>'; // Fee Amount

            // Action button for payment
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blank" href="'.route("student.tuition.fee.payment", ['class_id' => $student->class_id, 'student_id' => $student->student_id]).'">Pay Now</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json($html);
    }


    public function TuitionFeePaySlip(Request $request, $class_id, $student_id)
    {
        // Fetch the student's data
        $student = StudentData::where('student_id', $student_id)->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Calculate total amount with fee, discount, and late fee
        $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
            ->where('fee_category_id', 2)
            ->first();

        $promoCode = $request->input('promo_code');
        $months = $request->input('months', 1); // Default to 1 month
        $totalAmount = $feeAmount->fee_category_amount * $months;
        $discount = 0;
        $lateFee = 0;

        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->first();
            if ($promo && $promo->isValid()) {
                $discount = $promo->discount;
                $totalAmount = $totalAmount - ($totalAmount * ($discount / 100));
            }
        }

        // Calculate late fee
        if (date('d', strtotime($request->input('payment_date'))) > 10) {
            $lateFee = 500;
        }
        $totalAmount += $lateFee;

        // Store payment logic (if POST request) ...

        // Fetch all payments for the student to display
        $payments = Payments::where('student_id', $student->id)->get();

        // Pass data to the view, including payments
        return view('admin.backend.student.student_tuition_fee.pay_now', compact(
            'feeAmount', 'totalAmount', 'discount', 'lateFee', 'months', 'student', 'class_id', 'student_id', 'payments'
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
