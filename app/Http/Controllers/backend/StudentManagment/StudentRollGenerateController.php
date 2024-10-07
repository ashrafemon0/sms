<?php

namespace App\Http\Controllers\backend\StudentManagment;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRollGenerateController extends Controller
{
    public function StudentRollView(){

        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        return view('admin.backend.student.student_roll.student_roll_view',$data);
    }

    public function StudentRollGenerate(Request $request){

        $allData = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
//        dd($allData->toArray());
        return response()->json($allData);
    }

    public function StudentRollStore(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if ($request->student_id != null){
            for ($i=0; $i < count($request->student_id); $i++){
                 AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll'=>$request->roll[$i]]);

            }//end loop
        }else{
            $notification = array(
                'message' => 'Sorry There is no student',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'Well Done Roll Generate Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.roll.generate')->with($notification);

    }//End Method
}
