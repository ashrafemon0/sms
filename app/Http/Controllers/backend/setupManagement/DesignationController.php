<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function DesignationView(){
        $data['studentDesignation'] = Designation::all();
        return view('admin.backend.setup.StudentDesignation',$data);
    }

    public function DesignationAdd(){
        return view('admin.backend.setup.DesignationAdd');
    }

    public function DesignationStore(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:designations,name'
        ]);


        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation')->with($notification);
    }
    public function DesignationEdit($id){
        $DesignationEdit = Designation::findOrFail($id);
        return view('admin.backend.setup.DesignationEdit',compact('DesignationEdit'));
    }

    public function DesignationUpdate(Request $request, $id){
        $data = Designation::find($id);

//         Validate the request data
        $validateData = $request->validate([
            'name' => 'required|unique:designations,name,' . $data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation')->with($notification);
    }
    public function DesignationDelete($id){
        $data = Designation::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Designation Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('designation')->with($notification);
    }
}

