<?php

namespace App\Http\Controllers\backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentExamModel;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class MarksController extends Controller
{
    public function StudentMarksAdd(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = StudentExamModel::all();


        return view('admin.backend.Marks.marks_add',$data);
    }

    public function StudentMarksStore(Request $request){
        $studentCount = $request->student_id;
        $countData = count($studentCount);

        if ($studentCount){
            for ($i=0; $i < $countData; $i++){
                $data = New StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
        }
        $notification = array(
            'message' => 'Student Marks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StudentMarksEdit(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = StudentExamModel::all();

        return view('admin.backend.Marks.marks_edit', $data);
    }

    public function MarksEditGetStudents(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $data = StudentMarks::with(['student'])
            ->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('exam_type_id', $exam_type_id)
            ->get();

        return response()->json($data);
    }

}
