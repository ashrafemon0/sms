<?php

namespace App\Http\Controllers\backend\StudentManagment;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeCategoryAmount;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class StudentBookFeeController extends Controller
{
    public function StudentBookFeeView() {
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        $data['studentFeeCategory'] = StudentFeeCategory::all();
        return view('admin.backend.student.Student_Book_Fee.book_fee_view', $data);
    }
//    public function BookFeeClassWiseGet(Request $request) {
//        $year_id = $request->year_id;
//        $class_id = $request->class_id;
//        $fee_category_id = $request->fee_category_id;
//
//        // Build the query
//        $query = AssignStudent::with(['discount', 'student']);
//
//        if ($year_id != '') {
//            $query->where('year_id', $year_id);
//        }
//        if ($class_id != '') {
//            $query->where('class_id', $class_id);
//        }
//
//        $allStudent = $query->get();
//
//        if ($allStudent->isEmpty()) {
//            return response()->json(['error' => 'No data found'], 404);
//        }
//
//        $html['thsource'] = '<th>SL NO</th>';
//        $html['thsource'] .= '<th>ID NO</th>';
//        $html['thsource'] .= '<th>Student Name</th>';
//        $html['thsource'] .= '<th>Roll No</th>';
//        $html['thsource'] .= '<th>Class</th>';
//        $html['thsource'] .= '<th>Book Fee</th>';
//        $html['thsource'] .= '<th>Action</th>';
//
//        foreach ($allStudent as $key => $v) {
//            $registrationFee = StudentFeeCategoryAmount::where('fee_category_id', $fee_category_id)
//                ->where('class_id', $class_id)
//                ->first();
//
//            if (!$registrationFee) {
//                $html[$key]['tdsource'] = '<td colspan="7">No fee data available</td>';
//                continue;
//            }
//
//            $color = 'success';
//            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
//            $html[$key]['tdsource'] .= '<td>'.$registrationFee->FeeClass->name.'</td>';
//
//            $originalFee = (float)$registrationFee->fee_category_amount;
//            $html[$key]['tdsource'] .= '<td>'.$originalFee.' Tk'.'</td>';
//            $html[$key]['tdsource'] .= '<td>';
//            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank" href="'.route("student.book.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'">Fee Slip</a>';
//            $html[$key]['tdsource'] .= '</td>';
//        }
//
//        return response()->json($html);
//    }


    public function BookFeeClassWiseGet(Request $request) {
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
                ->where('fee_category_id', '5') // Assuming registration fee category ID is 1
                ->first();

            $html[$key]['tdsource'] = '<td>'.($key + 1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student->student_id.'</td>'; // Student ID
            $html[$key]['tdsource'] .= '<td>'.$student->name.'</td>'; // Student Name
            $html[$key]['tdsource'] .= '<td>Book Fee</td>'; // Fee Category (hardcoded here as an example)
            $html[$key]['tdsource'] .= '<td>'.$feeAmount->fee_category_amount.' Tk</td>'; // Fee Amount

            // Action button for payment
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blank" href="'.route("student.registration.fee.payslip", ['class_id' => $student->class_id, 'student_id' => $student->student_id]).'">Pay Now</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json($html);
    }
}
