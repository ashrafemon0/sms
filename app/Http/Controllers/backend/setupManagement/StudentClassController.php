<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function StudentClass(){

        $data['studentClass'] = StudentClass::all();
        return view('admin.backend.setup.studentClass',$data);
    }

    public function AddClass(){

        return view('admin.backend.setup.addClassView');

    }

    public function StoreClass(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:student_classes,name'
        ]);


        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Class Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class')->with($notification);


    }
    public function ClassEdit($id){
        $classEdit = StudentClass::findOrFail($id);
        return view('admin.backend.setup.classEdit',compact('classEdit'));
    }


    public function UpdateClass(Request $request, $id) {
        $data = StudentClass::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name,' . $data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Class Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class')->with($notification);
    }

}
