<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function StudentShift(){
        $data['studentShift'] = StudentShift::all();
        return view('admin.backend.setup.studentShift',$data);
    }

    public function StudentShiftAdd(){
        return view('admin.backend.setup.StudentShiftAdd');
    }

    public function StoreShift(Request $request){
        $validateData = $request->validate([
            'shift'=>'required|unique:student_shifts,shift'
        ]);


        $data = new StudentShift();
        $data->shift = $request->shift;
        $data->save();

        $notification = array(
            'message' => 'shift Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift')->with($notification);
    }

    public function ShiftEdit($id){
        $ShiftEdit = StudentShift::findOrFail($id);
        return view('admin.backend.setup.ShiftEdit',compact('ShiftEdit'));
    }

    public function UpdateShift(Request $request, $id){
        $data = StudentShift::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'shift' => 'required|unique:student_shifts,shift,' . $data->id,
        ]);

        $data->shift = $request->shift;
        $data->save();

        $notification = array(
            'message' => 'Shift Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift')->with($notification);
    }

    public function DeleteShift($id){
        $data = StudentShift::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Shift Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('student.shift')->with($notification);
    }

}
