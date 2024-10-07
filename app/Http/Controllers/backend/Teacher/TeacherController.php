<?php

namespace App\Http\Controllers\backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\DailyActivity;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function LessonPlanView(){
        $TeacherData = Teacher::all();

        return view('admin.backend.Teacher.teacher_view',compact('TeacherData'));
    }
    public function AddLessonPlan(){

        return view('admin.backend.Teacher.teacher_add');
    }

    public function StoreLessonPlan(Request $request){


        $data = new Teacher();
        $data->day = $request->day;
        $data->assembly = $request->assembly;
        $data->table_work = $request->table_work;
        $data->group_work = $request->group_work;
        $data->adl_activity = $request->adl_activity;
        $data->massy_play = $request->massy_play;
        $data->snack_time = $request->snack_time;
        $data->table_work_2 = $request->table_work_2;
        $data->physical_exercise = $request->physical_exercise;
        $data->save();

        $notification = array(
            'message' => 'Lesson Plan Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('lesson.plan.view')->with($notification);
    }

    public function DailyActivitiesView(){
        $activities = DailyActivity::all();
        return view('admin.backend.Teacher.daily_activities_view',compact('activities'));

    }
    public function DailyActivitiesAdd(){
        return view('admin.backend.Teacher.daily_activities_add');
    }

    public function StoreDailyActivities(Request $request){
        $request->validate([
            'date' => 'required|date',
            'Sname' => 'required|string|max:255',
            'Tname' => 'required|string|max:255',
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Handle the PDF upload
        if ($request->file('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
        }

        // Create a new record in the database
        DailyActivity::create([
            'date' => $request->date,
            'student_name' => $request->Sname,
            'teacher_name' => $request->Tname,
            'pdf' => $pdfPath,
        ]);
        $notification = array(
            'message' => 'Lesson Plan Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('Daily.activities.view')->with($notification);
    }

    public function destroy($id)
    {
        $activity = DailyActivity::findOrFail($id);

        // Delete the associated PDF file from storage
        if ($activity->pdf) {
            Storage::disk('public')->delete($activity->pdf);
        }

        // Delete the record from the database
        $activity->delete();
        $notification = array(
            'message' => 'Lesson Plan Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('Daily.activities.view')->with($notification);
    }
}
