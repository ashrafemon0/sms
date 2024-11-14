<?php

namespace App\Http\Controllers\backend\StudentManagment;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Payments;
use App\Models\PromoCode;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentFeeCategoryAmount;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentTshirtFeeController extends Controller
{
    public function StudentTshirtFeeView(){

        $user = auth()->user();

        $data['studentClass'] = StudentData::where('student_id', $user->user_id)->pluck('class_id'); // Fetch only the class for the logged-in user
        $data['studentYear'] = StudentData::where('student_id', $user->user_id)->pluck('year_id');
        return view('admin.backend.student.Student_Tshirt_Fee.tshirt_fee_view',$data);
    }

//    public function StudentTshirtFee(Request $request){
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
//        $html['thsource'] .= '<th>Class</th>';
//        $html['thsource'] .= '<th>T-Shirt Fee</th>';
//        $html['thsource'] .= '<th>Action</th>';
//
//        foreach ($allStudent as $key => $v){
//            $registrationFee = StudentFeeCategoryAmount::where('fee_category_id','4')->where('class_id',$v->class_id)->first();
//
//            $color = 'success';
//            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$registrationFee->FeeClass->name.'</td>';
//
//            $originalFee = (float)$registrationFee->fee_category_amount;
//
////            $discount = (float)$v['discount']['discount'];
////            $discountableFee = $discount/100*$originalFee;
////            $finalFee = $originalFee-$discountableFee;
//
//            $html[$key]['tdsource'] .= '<td>'.$originalFee.'Tk'.'</td>';
//            $html[$key]['tdsource'] .='<td>';
//            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank" href="'.route("student.book.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'">Fee Slip</a>';
//            $html[$key]['tdsource'] .='</td>';
//        }
//        return response()->json(@$html);
//    }

    public function StudentTshirtFee(Request $request) {
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
        // Get the logged-in user's user_id
        $userId = auth()->user()->user_id;

        // Fetch the student data where student_id matches user_id
        $allStudents = StudentData::where('student_id', $userId)
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        $html['thsource'] = '<th>SL NO</th>';
        $html['thsource'] .= '<th>Student ID</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Fee Category</th>';
        $html['thsource'] .= '<th>Fee Amount</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudents as $key => $student) {
            // Fetch fee category amount for the student class
            $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
                ->where('fee_category_id', '4') // Assuming registration fee category ID is 1
                ->first();

            $html[$key]['tdsource'] = '<td>'.($key + 1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student->student_id.'</td>'; // Student ID
            $html[$key]['tdsource'] .= '<td>'.$student->name.'</td>'; // Student Name
            $html[$key]['tdsource'] .= '<td>T-Shirt Fee</td>'; // Fee Category (hardcoded here as an example)
            $html[$key]['tdsource'] .= '<td>'.$feeAmount->fee_category_amount.' Tk</td>'; // Fee Amount

            // Action button for payment
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blank" href="'.route("student.tshirt.fee.payment", ['class_id' => $student->class_id, 'student_id' => $student->student_id]).'">Pay Now</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json($html);
    }

    public function showTshirtPaymentPage($class_id, $student_id, Request $request){
        // Fetch the fee amount for the given class and fee category
        $feeAmount = StudentFeeCategoryAmount::where('class_id', $class_id)
            ->where('fee_category_id', 4) // Assuming fee_category_id = 5 is for T-shirt
            ->first();

        // Fetch the student's data
        $student = StudentData::where('student_id', $student_id)->first();

        // Check if the student exists
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Get the quantity or set from the request (default to 1 if not provided)
        $quantityOrSet = $request->input('qun_set', 1);

        // Calculate the total amount based on the fee amount and quantity or set
        $totalAmount = $feeAmount ? $feeAmount->fee_category_amount * $quantityOrSet : 0;

        // Handle promo code (if provided)
        $promoCode = $request->input('promo_code');
        $discount = 0;

        // Check if the promo code is valid and apply the discount
        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->first();
            if ($promo && $promo->isValid()) {
                $discount = $promo->discount; // Assume this is a percentage
                $totalAmount = $totalAmount - ($totalAmount * ($discount / 100)); // Apply the discount
            }
        }

        // Fetch previous payments for this student
        $payments = Payments::where('student_id', $student->id)->get();

        // Pass the data to the view
        return view('admin.backend.student.Student_Tshirt_Fee.tshirt_fee_payment', compact('feeAmount', 'totalAmount', 'discount', 'student', 'payments', 'class_id', 'student_id', 'quantityOrSet'));

    }

}
