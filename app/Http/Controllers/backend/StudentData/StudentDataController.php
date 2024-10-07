<?php

namespace App\Http\Controllers\backend\StudentData;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentDataController extends Controller
{
    public function index()
    {
        $totalStudents = StudentData::count();
        $playGroupCount = StudentData::where('class_id', '1')->count();
        $nurseryCount = StudentData::where('class_id', '3')->count();
        $KgCount = StudentData::where('class_id', '2')->count();
        $SPLCount = StudentData::where('class_id', '6')->count();
        $ToddlerCount = StudentData::where('class_id', '4')->count();
        $Class1Count = StudentData::where('class_id', '5')->count();

        return view('admin.index', compact('totalStudents', 'playGroupCount', 'nurseryCount','KgCount','SPLCount','ToddlerCount','Class1Count'));
    }
    public function StudentDataView(){
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        return view('admin.backend.StudentData.student_data_view', $data);
    }
    public function StudentDataAdd(){
        $data['studentClass'] = StudentClass::all();
        $data['studentYear'] = StudentYear::all();
        return view('admin.backend.StudentData.student_data_add',$data);
    }
    public function StudentDataStore(Request $request){

        // Validate the request data
        $request->validate([
            'year_id' => 'required|integer',
            'class_id' => 'required|integer',
            'Sname' => 'required|string|max:255',
            'Sid' => 'required|string|max:255',
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('uploads', 'public');
        }

        // Create a new student activity record
        StudentData::create([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id,
            'name' => $request->Sname,
            'student_id' => $request->Sid,
            'pdf_path' => $pdfPath,
        ]);

        // Redirect with success message
        $notification = array(
            'message' => 'Student Register Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.all.data.view')->with($notification);
    }



    public function getStudentData(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $student_id = $request->student_id;

        $query = StudentData::query();

        if ($year_id) {
            $query->where('year_id', $year_id);
        }

        if ($class_id) {
            $query->where('class_id', $class_id);
        }

        if ($student_id) {
            $query->where('student_id', 'like', "%{$student_id}%");
        }

        $data = $query->paginate(10);

        $output = [];
        $serial_number = ($data->currentPage() - 1) * $data->perPage() + 1;

        foreach ($data as $row) {
            $output[] = [
                'tdsource' => "
                <td>{$serial_number}</td>
                <td>{$row->name}</td>
                <td>{$row->student_id}</td>
                <td><a href='". route('download.pdf', $row->id) ."' class='btn btn-success'>Download PDF</a></td>
            ",
            ];
            $serial_number++;
        }

        return response()->json([
            'data' => $output,
            'pagination' => $data->appends(request()->except('page'))->links('pagination::bootstrap-4')->render(), // Render Bootstrap pagination
        ]);
    }



    public function downloadPDF($id)
    {
        $activity = StudentData::findOrFail($id);

        $filePath = storage_path('app/public/' . $activity->pdf_path);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

}
