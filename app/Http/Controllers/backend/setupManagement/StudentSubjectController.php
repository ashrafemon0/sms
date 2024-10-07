<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentSubject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    public function StudentSubject(){
        $data['studentSubject'] = StudentSubject::all();
        return view('admin.backend.setup.StudentSubject',$data);
    }

    public function StudentSubjectAdd(){
        return view('admin.backend.setup.StudentSubjectAdd');
    }

    public function StoreSubject(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:student_subjects,name'
        ]);


        $data = new StudentSubject();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.subject')->with($notification);
    }

    public function SubjectEdit($id){
        $SubjectEdit = StudentSubject::findOrFail($id);
        return view('admin.backend.setup.SubjectEdit',compact('SubjectEdit'));
    }

    public function UpdateSubject(Request $request, $id){
        $data = StudentSubject::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'name' => 'required|unique:student_subjects,name,' . $data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.subject')->with($notification);
    }

    public function DeleteSubject($id){
        $data = StudentSubject::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Subject Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('student.subject')->with($notification);
    }
}

