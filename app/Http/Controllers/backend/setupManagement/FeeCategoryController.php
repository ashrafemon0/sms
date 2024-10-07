<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentFeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function StudentFeeCategory(){
        $data['FeeCategory'] = StudentFeeCategory::all();
        return view('admin.backend.setup.FeeCategory',$data);
    }
    public function StudentFeeCategoryAdd(){
        return view('admin.backend.setup.FeeCategoryAdd');
    }
    public function StudentFeeCategoryStore(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:student_fee_categories,name'
        ]);


        $data = new StudentFeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.feeCategory')->with($notification);
    }
    public function StudentFeeCategoryEdit($id){
        $FeeCategoryEdit = StudentFeeCategory::findOrFail($id);
        return view('admin.backend.setup.FeeCategoryEdit',compact('FeeCategoryEdit'));
    }
    public function StudentFeeCategoryUpdate(Request $request, $id){
        $data = StudentFeeCategory::find($id);

        // Validate the request data
        $validateData = $request->validate([
            'name' => 'required|unique:student_fee_categories,name,' . $data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'FeeCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.feeCategory')->with($notification);
    }
    public function StudentFeeCategoryDelete($id){
        $data = StudentFeeCategory::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Fee Category Delete Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('student.feeCategory')->with($notification);
    }
}
