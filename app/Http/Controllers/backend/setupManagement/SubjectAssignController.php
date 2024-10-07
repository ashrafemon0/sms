<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentSubject;
use App\Models\SubjectAssign;
use Illuminate\Http\Request;

class SubjectAssignController extends Controller
{
    public function StudentSubjectAssign(){

//        $data['FeeCategoryAmount'] = StudentFeeCategoryAmount::all();
        $data['SubjectAssign'] = SubjectAssign::select('class_id')->groupBy('class_id')->get();
        return view('admin.backend.setup.SubjectAssign',$data);

    }

    public function StudentSubjectAssignAdd(){

        $data['StudentSubject'] = StudentSubject::all();
        $data['StudentClass'] = StudentClass::all();

        return view('admin.backend.setup.SubjectAssignAdd',$data);

    }
    public function StudentSubjectAssignStore(Request $request){

        $CountSubject= count($request->subject_id);
        if ($CountSubject != NULL){
            for ($i=0; $i <$CountSubject ; $i++){
                $assign_sub = new SubjectAssign();
                $assign_sub->class_id = $request->class_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->subjective_mark = $request->subjective_mark[$i];
                $assign_sub->save();
            }
        }
        $notification = array(
            'message' => 'Subject Assign Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subject.assign')->with($notification);
    }

    public function StudentSubjectAssignEdit($id){

        $data['editData'] = SubjectAssign::where('class_id',$id)->orderBy('subject_id','asc')->get();
        $data['StudentSubject'] = StudentSubject::all();
        $data['StudentClass'] = StudentClass::all();

        return view('admin.backend.setup.SubjectAssignEdit',$data);

    }
    public function StudentSubjectAssignUpdate(Request $request, $class_id){

        if ($request->subject_id == NULL){
            $notification = array(
                'message' => 'Subject Assign Update Fail Because you do not Select any subject',
                'alert-type' => 'error'
            );

            return redirect()->route('subject.assign')->with($notification);
        }else{
            $CountSubject= count($request->subject_id);
            SubjectAssign::where('class_id',$class_id)->delete();
                for ($i=0; $i < $CountSubject ; $i++){
                    $assign_sub = new SubjectAssign();
                    $assign_sub->class_id = $request->class_id;
                    $assign_sub->subject_id = $request->subject_id[$i];
                    $assign_sub->full_mark = $request->full_mark[$i];
                    $assign_sub->pass_mark = $request->pass_mark[$i];
                    $assign_sub->subjective_mark = $request->subjective_mark[$i];
                    $assign_sub->save();
                }
        }
        $notification = array(
            'message' => 'Subject Assign Update Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subject.assign')->with($notification);
    }
    public function StudentSubjectAssignDetails($id){

        $data['SubjectAssignDetails'] = SubjectAssign::where('class_id',$id)->orderBy('subject_id','asc')->get();
        return view('admin.backend.setup.SubjectAssignDetails',$data);
    }

    public function DeleteSubjectAssign($id){
        $data = SubjectAssign::find($id);

        if ($data) {
            $data->delete();
            $notification = array(
                'message' => 'Subject Assign Delete Successfully',
                'alert-type' => 'warning'
            );
        } else {
            $notification = array(
                'message' => 'Subject Assign not found',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('SubjectAssign.details')->with($notification);
    }
}

