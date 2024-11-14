<?php

namespace App\Http\Controllers\backend\StudentData;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\StudentClass;
use App\Models\StudentData;
use App\Models\StudentFeeCategory;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StudentDataController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $currentYear = Carbon::now()->year;

        // Check if the user is an admin
        if ($user->role == 'admin') {
            // Admin dashboard data
            $totalStudents = StudentData::count();
            $playGroupCount = StudentData::where('class_id', '1')->count();
            $nurseryCount = StudentData::where('class_id', '3')->count();
            $KgCount = StudentData::where('class_id', '2')->count();
            $SPLCount = StudentData::where('class_id', '6')->count();
            $ToddlerCount = StudentData::where('class_id', '4')->count();
            $Class1Count = StudentData::where('class_id', '5')->count();

            // Return admin dashboard view
            return view('admin.index', compact('totalStudents', 'playGroupCount', 'nurseryCount', 'KgCount', 'SPLCount', 'ToddlerCount', 'Class1Count'));
        } else {

            // Initialize an array for all months with default status as "Due"
            $monthsStatus = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthsStatus[$i] = [
                    'month' => Carbon::createFromDate($currentYear, $i, 1)->format('F'),
                    'status' => 'Due'
                ];
            }

            // Initialize an array for all months with default status as "Due"
            $monthsStatus = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthsStatus[$i] = [
                    'month' => Carbon::createFromDate($currentYear, $i, 1)->format('F'),
                    'status' => 'Due'
                ];
            }

            // Retrieve the tuition fee category ID from the student_fee_categories table
            $tuitionFeeCategoryId = StudentFeeCategory::where('name', 'Tuition')->value('id');

            if ($tuitionFeeCategoryId) {
                // Join payments with student_fee_categories to get only payments for tuition fees
                $paidMonths = Payments::join('student_fee_categories', 'student_fee_categories.id', '=', 'payments.category_id')
                    ->where('payments.user_id', $user->id)
                    ->whereYear('payments.payment_date', $currentYear)
                    ->where('student_fee_categories.id', $tuitionFeeCategoryId)
                    ->get(['payments.payment_date']);

                // Update the status to "Paid" for each month that has a tuition fee payment record
                foreach ($paidMonths as $payment) {
                    $month = Carbon::parse($payment->payment_date)->month;
                    $monthsStatus[$month]['status'] = 'Paid';
                }
            }
            // Return student dashboard view
            return view('admin.StIndex',compact('monthsStatus'));
        }
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
