<?php

namespace App\Http\Controllers\backend\EmployeeManage;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\EmployeeAttendance;
use App\Models\StudentFeeCategoryAmount;
use Illuminate\Http\Request;

use PDF;

class EmployeeMonthlySalaryController extends Controller
{
    public function EmployeeMonthlySalaryView(){
        return view('admin.backend.employee.employee_monthly_salary.employee_monthly_salary_view');
    }
    public function EmployeeMonthlySalaryGet(Request $request){
        $date = date('Y-m',strtotime($request->date));

        if ($date != ''){
            $where[] = ['date','like',$date.'%'];
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        //dd($data->toArray());
        $html['thsource'] = '<th>SL NO</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($data as $key => $attend){
            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentCount = count($totalAttend->where('atten_status','Absent'));
            //dd($absentCount);

            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';


            $salary = (float)$attend['user']['salary'];
            $perDaySalary = (float)$salary/30;
            $totalSalaryMinus = (float)$absentCount*(float)$perDaySalary;
            $TotalSalary = (float)$salary-(float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>'.$TotalSalary.'Tk'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'">Fee Slip</a>';
            $html[$key]['tdsource'] .='</td>';
        }
        return response()->json(@$html);
    }

    public function EmployeeMonthlySalaryPayslip(Request $request,$employee_id){
        $id = EmployeeAttendance::where('employee_id',$employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
        if ($date != ''){
            $where[] = ['date','like',$date.'%'];
        }

        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id->employee_id)->get();


        $pdf = PDF::loadView('admin.backend.employee.employee_salary.salary_pay_slip',$data);
        return $pdf->stream('document.pdf');
    }
}
