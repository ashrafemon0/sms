<?php

namespace App\Http\Controllers\backend\StudentManagment;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class StudentRegController extends Controller
{
    public function StudentRegView(){
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        $data['class_id']= StudentClass::orderBy('id','DESC')->get()->first()->id;
        $data['year_id']= StudentYear::orderBy('id','DESC')->get()->first()->id;
        $data['allData']=AssignStudent::where('year_id',$data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('admin.backend.student.student_reg.student_view',$data);
    }

    public function SearchStudent(Request $request){
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        $data['class_id']= $request->class_id;
        $data['year_id']= $request->year_id;
        $data['allData']=AssignStudent::where('year_id',$request->year_id)->where('class_id', $request->class_id)->get();
        return view('admin.backend.student.student_reg.student_view',$data);
    }

    public function AddStudent(){
        $data['studentClass'] = StudentClass::all();
        $data['studentGroup'] = StudentGroup::all();
        $data['studentYear'] = StudentYear::all();
        $data['studentShift'] = StudentShift::all();
        return view('admin.backend.student.student_reg.student_add',$data);
    }

    public function StoreRegistration(Request $request){
        DB::transaction(function () use ($request){
            $checkYear = StudentYear::find($request->year_id)->year;
            $student = User::where('usertype','Student')->orderBy('id','DESC')->first();
            if ($student == null){
                $firstReg = 0;
                $studentId = $firstReg+1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif ($studentId < 100){
                    $id_no = '00'.$studentId;
                }elseif ($studentId < 1000){
                    $id_no = '0'.$studentId;
                }
            }else{
                $student = User::where('usertype','Student')->orderBy('id','DESC')->first()->id;
                $studentId = $student+1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif ($studentId < 100){
                    $id_no = '00'.$studentId;
                }elseif ($studentId < 1000){
                    $id_no = '0'.$studentId;
                }
            }

            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if ($request->file('image')){
                $file = $request->file('image');
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/user_image'),$fileName);
                $user['image'] = $fileName;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;

            $assign_student->save();

            $discount = new DiscountStudent();
            $discount->assign_student_id = $assign_student->id;
            $discount->fee_category_id = '1';
            $discount->discount = $request->discount;

            $discount->save();

        });
        $notification = array(
            'message' => 'Student Register Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.reg')->with($notification);
    }

    public function StudentRegEdit($student_id){
        $data['studentClass'] = StudentClass::all();
        $data['studentGroup'] = StudentGroup::all();
        $data['studentYear'] = StudentYear::all();
        $data['studentShift'] = StudentShift::all();

        $data['EditData'] = AssignStudent::with('student','discount')->where('student_id',$student_id)->first();

//        dd( $data['EditData']->toArray());
        return view('admin.backend.student.student_reg.student_edit',$data);
    }
    public function StudentRegUpdate(Request $request,$student_id){
        DB::transaction(function() use($request,$student_id){


            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_image/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/user_image'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();

            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();

            $discount_student->discount = $request->discount;
            $discount_student->save();

        });


        $notification = array(
            'message' => 'Student Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.reg')->with($notification);

    } // End Method

    public function StudentRegPromotion($student_id){
        $data['studentClass'] = StudentClass::all();
        $data['studentGroup'] = StudentGroup::all();
        $data['studentYear'] = StudentYear::all();
        $data['studentShift'] = StudentShift::all();

        $data['EditData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();

//        dd($data['EditData']->toArray());
        return view('admin.backend.student.student_reg.promotion',$data);
    }

    public function UpdateRegPromotion(Request $request, $student_id){
        DB::transaction(function() use($request,$student_id){


            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_image/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/user_image'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();

            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();

            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();

        });


        $notification = array(
            'message' => 'Student Promotion Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.reg')->with($notification);
    }

    public function StudentPromotionDetails($student_id){
        $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $pdf = PDF::loadView('admin.backend.student.student_reg.promotion_details', $data);
        return $pdf->stream('document.pdf');
    }

}
