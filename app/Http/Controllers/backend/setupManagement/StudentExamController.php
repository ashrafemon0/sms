<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentExamModel;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function StudentExam(){
        $data['studentExam'] = StudentExamModel::all();
        return view('admin.backend.setup.StudentExam',$data);
    }
    public function StudentExamAdd(){
        return view('admin.backend.setup.StudentExamAdd');
    }

    public function StoreExam(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:student_exam_models,name'
        ]);


        $data = new StudentExamModel();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.exam')->with($notification);
    }

    public function ExamEdit($id){
        $ExamEdit = StudentExamModel::findOrFail($id);
        return view('admin.backend.setup.ExamEdit',compact('ExamEdit'));
    }

    public function UpdateExam(Request $request, $id){
        $data = StudentExamModel::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'name' => 'required|unique:student_exam_models,name,' . $data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.exam')->with($notification);
    }

    public function DeleteExam($id){
        $data = StudentExamModel::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Exam Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('student.exam')->with($notification);
    }
}

