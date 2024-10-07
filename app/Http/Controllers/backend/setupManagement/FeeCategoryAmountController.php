<?php

namespace App\Http\Controllers\backend\setupManagement;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeCategoryAmount;
use Illuminate\Http\Request;

class FeeCategoryAmountController extends Controller
{
    public function StudentFeeCategoryAmount(){

//        $data['FeeCategoryAmount'] = StudentFeeCategoryAmount::all();
        $data['FeeCategoryAmount'] = StudentFeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
//        dd($data['FeeCategoryAmount']->toArray()); 111=1,222=2,333=3
        return view('admin.backend.setup.FeeCategoryAmount',$data);

    }
    public function StudentFeeCategoryAmountAdd(){

        $data['FeeCategory'] = StudentFeeCategory::all();
        $data['StudentClass'] = StudentClass::all();

        return view('admin.backend.setup.FeeCategoryAmountAdd',$data);

    }
    public function StudentFeeCategoryAmountStore(Request $request){

        $CountClass = count($request->class_id);
        if ($CountClass != NULL){
            for ($i=0; $i <$CountClass ; $i++){
                $fee_amount = new StudentFeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->fee_category_amount = $request->fee_category_amount[$i];
                $fee_amount->save();
            }
        }
        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.feeCategoryAmount')->with($notification);
    }
    public function StudentFeeCategoryAmountEdit($id){

        $data['editData'] = StudentFeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
        $data['FeeCategory'] = StudentFeeCategory::all();
        $data['StudentClass'] = StudentClass::all();

       return view('admin.backend.setup.FeeCategoryAmmountEdit',$data);


    }
    public function StudentFeeCategoryAmountUpdate(Request $request, $fee_category_id){

        if ($request->class_id == NULL){
            $notification = array(
                'message' => 'Fee Amount Fail Because you do not Select any Class',
                'alert-type' => 'error'
            );

            return redirect()->route('student.feeCategoryAmount')->with($notification);
        }else{
            $CountClass = count($request->class_id);
            StudentFeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
                for ($i=0; $i <$CountClass ; $i++){
                    $fee_amount = new StudentFeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->fee_category_amount = $request->fee_category_amount[$i];
                    $fee_amount->save();
                }

        }
        $notification = array(
            'message' => 'Fee Amount Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.feeCategoryAmount')->with($notification);
    }

    public function StudentFeeCategoryAmountDetails($id){

        $data['FeeAmountDetails'] = StudentFeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id','asc')->get();
        return view('admin.backend.setup.FeeAmountDetails',$data);
    }
}
