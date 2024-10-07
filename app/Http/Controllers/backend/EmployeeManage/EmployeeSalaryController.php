<?php

namespace App\Http\Controllers\backend\EmployeeManage;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class EmployeeSalaryController extends Controller
{
    public function EmployeeSalaryView(){

        $data['allData'] = User::where('usertype','employee')->get();

        return view('admin.backend.employee.employee_salary.employee_salary_view',$data);
    }

    public function EmployeeSalaryIncrement($id){
        $data['allData'] = User::find($id);

        return view('admin.backend.employee.employee_salary.employee_salary_increment',$data);
    }

    public function EmployeeSalaryStore(Request $request, $id){

        $user = User::find($id);

        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $SalaryData = new EmployeeSalaryLog();
        $SalaryData->employee_id = $id;
        $SalaryData->previous_salary = $previous_salary;
        $SalaryData->increment_salary = $request->increment_salary;
        $SalaryData->present_salary = $present_salary;
        $SalaryData->effected_salary = $request->effected_salary;
        $SalaryData->save();

        $notification = array(
            'message' => 'Employee Salary Increment Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.salary')->with($notification);
    }

    public function EmployeeSalaryDetails($id){
        $data['allData'] = User::find($id);
        $data['salaryLog'] = EmployeeSalaryLog::where('employee_id',$id)->get();
//        dd( $data['salaryLog']->toArray());

        return view('admin.backend.employee.employee_salary.employee_salary_pdf', $data);


    }
}
