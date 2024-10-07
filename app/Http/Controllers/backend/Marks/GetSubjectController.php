<?php

namespace App\Http\Controllers\backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\SubjectAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PharIo\Version\Exception;

class GetSubjectController extends Controller
{
    public function GetSubject(Request $request){

        $class_id = $request->class_id;
        $allData = SubjectAssign::with(['FeeClass'])->where('class_id',$class_id)->get();
//        dd($allData->toArray());

        return response()->json($allData);

    }
    public function GetStudents(Request $request){

        try {
            $year_id = $request->year_id;
            $class_id = $request->class_id;

            $allData = AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
            //dd($allData->toArray());

            return response()->json($allData);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

    }
}
