<?php

namespace App\Http\Controllers\backend\EmployeeManage;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function EmployeeAttendanceView(){
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
        //$data['allData'] = EmployeeAttendance::orderBy('id','desc')->get();
        //dd($data['allData']->toArray());
        return view('admin.backend.employee.employee_attendance.employee_attendance_view',$data);
    }

    public function EmployeeAttendanceAdd(){

        $data['employee'] = User::where('usertype','employee')->get();
//        dd($data['employee']->toArray());
        return view('admin.backend.employee.employee_attendance.employee_attendance_add',$data);
    }

    public function EmployeeAttendanceStore(Request $request){

        $countEmployee = count($request->employee_id);

        for ($i=0; $i < $countEmployee; $i++){
            $attend_status = 'atten_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->atten_status = $request->$attend_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Employee Leave Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attendance')->with($notification);
    }

    public function EmployeeAttendanceEdit($date){
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
        $data['employees'] = User::where('usertype','employee')->get();
        return view('admin.backend.employee.employee_attendance.employee_attendance_edit',$data);
    }

    public function EmployeeAttendanceDetails($date){
        $data['details'] = EmployeeAttendance::where('date',$date)->get();
        //dd($data['details']->toArray());
        return view('admin.backend.employee.employee_attendance.employee_attendance_details',$data);

    }
}
