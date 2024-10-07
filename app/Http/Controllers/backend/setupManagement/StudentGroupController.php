<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function StudentGroup(){
        $data['studentGroup'] = StudentGroup::all();
        return view('admin.backend.setup.studentGroup',$data);
    }
    public function StudentGroupAdd(){
        return view('admin.backend.setup.StudentGroupAdd');
    }

    public function StoreGroup(Request $request){
        $validateData = $request->validate([
            'group'=>'required|unique:student_groups,group'
        ]);


        $data = new StudentGroup();
        $data->group = $request->group;
        $data->save();

        $notification = array(
            'message' => 'Group Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group')->with($notification);
    }
    public function GroupEdit($id){
        $GroupEdit = StudentGroup::findOrFail($id);
        return view('admin.backend.setup.groupEdit',compact('GroupEdit'));
    }

    public function UpdateYear(Request $request, $id){
        $data = StudentGroup::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'group' => 'required|unique:student_groups,group,' . $data->id,
        ]);

        $data->group = $request->group;
        $data->save();

        $notification = array(
            'message' => 'group Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group')->with($notification);
    }
    public function groupDelete($id){
        $data = StudentGroup::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Group Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('student.group')->with($notification);
    }
}
