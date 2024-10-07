<?php

namespace App\Http\Controllers\backend\EmployeeManage;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Designation;
use App\Models\DiscountStudent;
use App\Models\EmployeeSalaryLog;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeRegController extends Controller
{
    public function EmployeeRegView(){

        $data['allData'] = User::where('usertype','employee')->get();

        return view('admin.backend.employee.employee_reg.employee_reg_view',$data);
    }

    public function EmployeeAdd(){

        $data['designation'] = Designation::all();
        return view('admin.backend.employee.employee_reg.employee_reg_add',$data);
    }

    public function EmployeeStore(Request $request){
        DB::transaction(function () use ($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();
            if ($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if ($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif ($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif ($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }else{
                $student = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $student+1;
                if ($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif ($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif ($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }

            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->designation_id = $request->designation_id;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if ($request->file('image')){
                $file = $request->file('image');
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/user_image'),$fileName);
                $user['image'] = $fileName;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->effected_salary = date('Y-m-d',strtotime($request->join_date));

            $employee_salary->save();

        });
        $notification = array(
            'message' => 'Employee Register Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.reg')->with($notification);

    }
    public function EmployeeEdit($id){

        $data['employeeEdit'] = User::find($id);
//        dd($data['employeeEdit']->toArray());
        $data['designation'] = Designation::all();
//        dd($data['designation']->toArray());
        return view('admin.backend.employee.employee_reg.employee_reg_edit',$data);
    }

    public function EmployeeUpdate(Request $request,$id){


            $user =  User::find($id);
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if ($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/user_image/'.$user->image));
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/user_image'),$fileName);
                $user['image'] = $fileName;
            }
            $user->save();

        $notification = array(
            'message' => 'Employee Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.reg')->with($notification);

    }

    public function EmployeeDetails($id){
        $data['details'] = User::find($id);
//        dd( $data['details']->toArray());

        $pdf = PDF::loadView('admin.backend.employee.employee_reg.EmployeeRegPdf', $data);
        return $pdf->stream('document.pdf');
    }
}
