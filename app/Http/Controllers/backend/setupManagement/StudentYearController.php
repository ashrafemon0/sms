<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function StudentYear(){
        $data['studentYear'] = StudentYear::all();
        return view('admin.backend.setup.studentCYear',$data);
    }
    public function StudentYearAdd(){

        return view('admin.backend.setup.StudentYearAdd');
    }

    public function StoreYear(Request $request){
        $validateData = $request->validate([
            'year'=>'required|unique:student_years,year'
        ]);


        $data = new StudentYear();
        $data->year = $request->year;
        $data->save();

        $notification = array(
            'message' => 'Year Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year')->with($notification);
    }
    public function YearEdit($id){
        $YearEdit = StudentYear::findOrFail($id);
        return view('admin.backend.setup.YearEdit',compact('YearEdit'));
    }

    public function UpdateYear(Request $request, $id){
        $data = StudentYear::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'year' => 'required|unique:student_years,year,' . $data->id,
        ]);

        $data->year = $request->year;
        $data->save();

        $notification = array(
            'message' => 'Year Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year')->with($notification);
    }

    public function YearDelete($id){
        $data = StudentYear::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Year Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('student.year')->with($notification);
    }
}
