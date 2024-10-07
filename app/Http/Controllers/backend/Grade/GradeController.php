<?php

namespace App\Http\Controllers\backend\Grade;

use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function StudentMarksGrade(){
        $data['allData'] = StudentGrade::all();

        return view('admin.backend.Marks.marks_grade_view',$data);
    }
    public function StudentMarksGradeAdd(){
        return view('admin.backend.Marks.grade_add');
    }

    public function StudentMarksGradeStore(Request $request){
        $data = new StudentGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark = $request->start_mark;
        $data->end_mark = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remark;
        $data->save();

        $notification = array(
            'message' => 'Grade Marks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.marks.grade')->with($notification);

    }

    public function StudentMarksGradeEdit($id){
        $data['allData'] = StudentGrade::find($id);

        return view('admin.backend.Marks.marks_grade_edit',$data);
    }

    public function StudentMarksGradeUpdate(Request $request, $id){

        $data = StudentGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark = $request->start_mark;
        $data->end_mark = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'message' => 'Grade Marks Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.marks.grade')->with($notification);
    }
}
