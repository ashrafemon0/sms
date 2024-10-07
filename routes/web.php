<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\Account\AccountSalaryController;
use App\Http\Controllers\backend\Account\AccountStudentFeeController;
use App\Http\Controllers\backend\Account\other_coast\OtherCostController;
use App\Http\Controllers\backend\EmployeeManage\EmployeeAttendanceController;
use App\Http\Controllers\backend\EmployeeManage\EmployeeLeaveController;
use App\Http\Controllers\backend\EmployeeManage\EmployeeMonthlySalaryController;
use App\Http\Controllers\backend\EmployeeManage\EmployeeRegController;
use App\Http\Controllers\backend\EmployeeManage\EmployeeSalaryController;
use App\Http\Controllers\backend\Grade\GradeController;
use App\Http\Controllers\backend\Marks\GetSubjectController;
use App\Http\Controllers\backend\Marks\MarksController;
use App\Http\Controllers\backend\payment\PaymentController;
use App\Http\Controllers\backend\Report\AttenReportController;
use App\Http\Controllers\backend\Report\MarkSheetController;
use App\Http\Controllers\backend\Report\ProfitController;
use App\Http\Controllers\backend\Report\ResultReportController;
use App\Http\Controllers\backend\setupManagement\DesignationController;
use App\Http\Controllers\backend\setupManagement\FeeCategoryAmountController;
use App\Http\Controllers\backend\setupManagement\FeeCategoryController;
use App\Http\Controllers\backend\setupManagement\StudentClassController;
use App\Http\Controllers\backend\setupManagement\StudentExamController;
use App\Http\Controllers\backend\setupManagement\StudentGroupController;
use App\Http\Controllers\backend\setupManagement\StudentShiftController;
use App\Http\Controllers\backend\setupManagement\StudentSubjectController;
use App\Http\Controllers\backend\setupManagement\StudentYearController;
use App\Http\Controllers\backend\setupManagement\SubjectAssignController;
use App\Http\Controllers\backend\StudentData\StudentDataController;
use App\Http\Controllers\backend\StudentManagment\StudentAssessmentFeeController;
use App\Http\Controllers\backend\StudentManagment\StudentBookFeeController;
use App\Http\Controllers\backend\StudentManagment\StudentExampFeeController;
use App\Http\Controllers\backend\StudentManagment\StudentRegController;
use App\Http\Controllers\backend\StudentManagment\StudentRegFeeController;
use App\Http\Controllers\backend\StudentManagment\StudentRollGenerateController;
use App\Http\Controllers\backend\StudentManagment\StudentTshirtFeeController;
use App\Http\Controllers\backend\StudentManagment\StudentTuitionFeeController;
use App\Http\Controllers\backend\Teacher\TeacherController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\PaymentTestController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [StudentDataController::class, 'index'])->name('dashboard');
});
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');

    // routes accessible only to admins

Route::middleware(['admin'])->group(function () {

Route::prefix('user')->group(function (){
    Route::get('/view',[UserController::class,'UserView'])->name('user.view');
    Route::get('/add',[UserController::class,'UserAdd'])->name('add.user');
    Route::post('/store',[UserController::class,'UserStore'])->name('store.user');
    Route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('user.edit');
    Route::post('/update/{id}',[UserController::class,'UserUpdate'])->name('update.user');
    Route::get('/delete/{id}',[UserController::class,'UserDelete'])->name('user.delete');
});
Route::prefix('profile')->group(function (){
    Route::get('/user',[ProfileController::class,'UserProfile'])->name('user.profile');
    Route::get('/edit',[ProfileController::class,'ProfileEdit'])->name('edit.profile');
    Route::post('/update',[ProfileController::class,'ProfileUpdate'])->name('store.profile');
    Route::get('/changepassword',[ProfileController::class,'ChangePassword'])->name('change.password');
    Route::post('/password',[ProfileController::class,'SavePassword'])->name('store.password');
});

Route::prefix('setup')->group(function (){
    Route::get('/student/class/view',[StudentClassController::class,'StudentClass'])->name('student.class');
    Route::get('/student/class/add',[StudentClassController::class,'AddClass'])->name('add.class');
    Route::post('/student/class/store',[StudentClassController::class,'StoreClass'])->name('store.class');
    Route::get('/student/class/edit/{id}',[StudentClassController::class,'ClassEdit'])->name('class.edit');
    Route::post('/student/class/update/{id}',[StudentClassController::class,'UpdateClass'])->name('class.update');
    Route::post('/student/class/delete/{id}',[StudentClassController::class,'ClassDelete'])->name('class.delete');

    Route::get('/student/year/view',[StudentYearController::class,'StudentYear'])->name('student.year');
    Route::get('/student/year/add',[StudentYearController::class,'StudentYearAdd'])->name('add.year');
    Route::post('/student/Year/store',[StudentYearController::class,'StoreYear'])->name('store.year');
    Route::get('/student/year/edit/{id}',[StudentYearController::class,'YearEdit'])->name('year.edit');
    Route::post('/student/Year/update/{id}',[StudentYearController::class,'UpdateYear'])->name('update.year');
    Route::get('/student/year/delete/{id}',[StudentYearController::class,'YearDelete'])->name('year.delete');

    Route::get('/student/group/view',[StudentGroupController::class,'StudentGroup'])->name('student.group');
    Route::get('/student/group/add',[StudentGroupController::class,'StudentGroupAdd'])->name('add.group');
    Route::post('/student/group/store',[StudentGroupController::class,'StoreGroup'])->name('store.group');
    Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'GroupEdit'])->name('group.edit');


    Route::get('/student/year/edit/{id}',[StudentGroupController::class,'GroupEdit'])->name('year.edit');
    Route::post('/student/group/update/{id}',[StudentGroupController::class,'UpdateYear'])->name('update.group');
    Route::get('/student/group/delete/{id}',[StudentGroupController::class,'groupDelete'])->name('group.delete');

    Route::get('/student/shift/view',[StudentShiftController::class,'StudentShift'])->name('student.shift');
    Route::get('/student/shift/add',[StudentShiftController::class,'StudentShiftAdd'])->name('add.shift');
    Route::post('/student/shift/store',[StudentShiftController::class,'StoreShift'])->name('store.shift');
    Route::get('/student/shift/edit/{id}',[StudentShiftController::class,'ShiftEdit'])->name('shift.edit');
    Route::post('/student/Shift/update/{id}',[StudentShiftController::class,'UpdateShift'])->name('update.shift');
    Route::get('/student/Shift/delete/{id}',[StudentShiftController::class,'DeleteShift'])->name('shift.delete');

    Route::get('/student/feeCategory/view',[FeeCategoryController::class,'StudentFeeCategory'])->name('student.feeCategory');
    Route::get('/student/feeCategory/add',[FeeCategoryController::class,'StudentFeeCategoryAdd'])->name('add.FeeCategory');
    Route::post('/student/feeCategory/store',[FeeCategoryController::class,'StudentFeeCategoryStore'])->name('store.FeeCategory');
    Route::get('/student/feeCategory/edit/{id}',[FeeCategoryController::class,'StudentFeeCategoryEdit'])->name('FeeCategory.edit');
    Route::post('/student/feeCategory/update/{id}',[FeeCategoryController::class,'StudentFeeCategoryUpdate'])->name('update.FeeCategory');
    Route::get('/student/feeCategory/delete/{id}',[FeeCategoryController::class,'StudentFeeCategoryDelete'])->name('FeeCategory.delete');

    Route::get('/student/feeCategoryAmount/view',[FeeCategoryAmountController::class,'StudentFeeCategoryAmount'])->name('student.feeCategoryAmount');
    Route::get('/student/feeCategoryAmount/add',[FeeCategoryAmountController::class,'StudentFeeCategoryAmountAdd'])->name('add.FeeCategoryAmount');
    Route::post('/student/feeCategoryAmount/store',[FeeCategoryAmountController::class,'StudentFeeCategoryAmountStore'])->name('store.FeeCategoryAmount');
    Route::get('/student/feeCategoryAmount/edit/{id}',[FeeCategoryAmountController::class,'StudentFeeCategoryAmountEdit'])->name('FeeCategory.edit');
    Route::post('/student/feeCategoryAmount/update/{fee_category_id}',[FeeCategoryAmountController::class,'StudentFeeCategoryAmountUpdate'])->name('update.FeeCategoryAmount');
    Route::get('/student/feeCategoryAmount/details/{id}',[FeeCategoryAmountController::class,'StudentFeeCategoryAmountDetails'])->name('FeeCategory.details');

    Route::get('/student/exam/view',[StudentExamController::class,'StudentExam'])->name('student.exam');
    Route::get('/student/exam/add',[StudentExamController::class,'StudentExamAdd'])->name('add.exam');
    Route::post('/student/exam/store',[StudentExamController::class,'StoreExam'])->name('store.exam');
    Route::get('/student/exam/edit/{id}',[StudentExamController::class,'ExamEdit'])->name('exam.edit');
    Route::post('/student/exam/update/{id}',[StudentExamController::class,'UpdateExam'])->name('update.exam');
    Route::get('/student/exam/delete/{id}',[StudentExamController::class,'DeleteExam'])->name('exam.delete');

    Route::get('/student/subject/view',[StudentSubjectController::class,'StudentSubject'])->name('student.subject');
    Route::get('/student/subject/add',[StudentSubjectController::class,'StudentSubjectAdd'])->name('add.subject');
    Route::post('/student/subject/store',[StudentSubjectController::class,'StoreSubject'])->name('store.subject');
    Route::get('/student/subject/edit/{id}',[StudentSubjectController::class,'SubjectEdit'])->name('subject.edit');
    Route::post('/student/subject/update/{id}',[StudentSubjectController::class,'UpdateSubject'])->name('update.subject');
    Route::get('/student/subject/delete/{id}',[StudentSubjectController::class,'DeleteSubject'])->name('subject.delete');

    Route::get('/student/subjectAssign/view',[SubjectAssignController::class,'StudentSubjectAssign'])->name('subject.assign');
    Route::get('/student/subjectAssign/add',[SubjectAssignController::class,'StudentSubjectAssignAdd'])->name('add.SubjectAssign');
    Route::post('/student/subjectAssign/store',[SubjectAssignController::class,'StudentSubjectAssignStore'])->name('store.SubjectAssign');
    Route::get('/student/subjectAssign/edit/{id}',[SubjectAssignController::class,'StudentSubjectAssignEdit'])->name('SubjectAssign.edit');
    Route::post('/student/subjectAssign/update/{class_id}',[SubjectAssignController::class,'StudentSubjectAssignUpdate'])->name('update.SubjectAssign');
    Route::get('/student/subjectAssign/details/{id}',[SubjectAssignController::class,'StudentSubjectAssignDetails'])->name('SubjectAssign.details');
    Route::get('/student/subjectAssign/delete/{id}',[SubjectAssignController::class,'DeleteSubjectAssign'])->name('SubjectAssign.delete');


    Route::get('/teacher/designation/view',[DesignationController::class,'DesignationView'])->name('designation');
    Route::get('/teacher/designation/add',[DesignationController::class,'DesignationAdd'])->name('add.designation');
    Route::post('/teacher/designation/store',[DesignationController::class,'DesignationStore'])->name('store.designation');
    Route::get('/teacher/designation/edit/{id}',[DesignationController::class,'DesignationEdit'])->name('designation.edit');
    Route::post('/teacher/designation/update/{id}',[DesignationController::class,'DesignationUpdate'])->name('update.designation');
    Route::get('/teacher/designation/delete/{id}',[DesignationController::class,'DesignationDelete'])->name('designation.delete');
});

//Student Registration Route
Route::prefix('student')->group(function (){
    Route::get('/reg/view',[StudentRegController::class,'StudentRegView'])->name('student.reg');
    Route::get('/reg/add',[StudentRegController::class,'AddStudent'])->name('add.student');
    Route::post('/reg/store',[StudentRegController::class,'StoreRegistration'])->name('store.student.reg');

    Route::get('/reg/search',[StudentRegController::class,'SearchStudent'])->name('student.class.year.wise');
    Route::get('/reg/edit/{student_id}',[StudentRegController::class,'StudentRegEdit'])->name('student.reg.edit');
    Route::post('/reg/update/{student_id}}',[StudentRegController::class,'StudentRegUpdate'])->name('update.student.reg');

    //Student Promotion Route
    Route::get('/reg/promotion/{student_id}}',[StudentRegController::class,'StudentRegPromotion'])->name('student.reg.promotion');
    Route::post('/promotion/update/{student_id}}',[StudentRegController::class,'UpdateRegPromotion'])->name('update.student.promotion');
    Route::get('/promotion/details/{student_id}}',[StudentRegController::class,'StudentPromotionDetails'])->name('student.registration.details');


    //Student Roll Generate Route
    Route::get('/roll/view',[StudentRollGenerateController::class,'StudentRollView'])->name('student.roll.generate');
    Route::get('/roll/getGenerate',[StudentRollGenerateController::class,'StudentRollGenerate'])->name('student.roll.get');
    Route::post('/roll/store',[StudentRollGenerateController::class,'StudentRollStore'])->name('student.roll.store');


    //Student Registration Fee Route
    Route::get('/reg/fee/view',[StudentRegFeeController::class,'StudentRegFeeView'])->name('student.registration.fee');
    Route::get('/reg/fee/classwiseget',[StudentRegFeeController::class,'RegFeeClassWiseGet'])->name('student.registration.fee.classwise.get');
    Route::get('/reg/fee/payslip',[StudentRegFeeController::class,'RegFeePaySlip'])->name('student.registration.fee.payslip');

    Route::get('student/registration/fee/payment/{class_id}/{student_id}', [StudentRegFeeController::class, 'showPaymentPage'])->name('student.registration.fee.payment');


    //Student Tuition Fee Route
    Route::get('/tuition/fee/view',[StudentTuitionFeeController::class,'StudentTuitionFeeView'])->name('student.tuition.fee');
    Route::get('/tuition/fee/classwiseget',[StudentTuitionFeeController::class,'TuitionFeeClassWiseGet'])->name('student.tuition.fee.classwise.get');
    Route::get('/tuition/fee/payslip',[StudentTuitionFeeController::class,'TuitionFeePaySlip'])->name('student.tuition.fee.payslip');

    Route::get('student/tuition/fee/payment/{class_id}/{student_id}', [StudentTuitionFeeController::class, 'TuitionFeePaySlip'])->name('student.tuition.fee.payment');

    Route::match(['get', 'post'], '/tuition-fee-pay-slip/{class_id}/{student_id}', [PaymentController::class, 'TuitionFeePaySlip'])->name('tuition.fee.pay.slipe');


    //Student Exam Fee Route
    Route::get('/tuition/exam/view',[StudentExampFeeController::class,'StudentExamFeeView'])->name('student.exam.fee');
    Route::get('/tuition/exam/classwiseget',[StudentExampFeeController::class,'ExamFeeClassWiseGet'])->name('student.exam.fee.classwise.get');
    Route::get('/tuition/exam/payslip',[StudentExampFeeController::class,'ExamFeePaySlip'])->name('student.exam.fee.payslip');

    //Student Book Fee Route
    Route::get('/book/fee/view',[StudentBookFeeController::class,'StudentBookFeeView'])->name('student.book.fee');
    Route::get('/book/fee/classwiseget',[StudentBookFeeController::class,'BookFeeClassWiseGet'])->name('student.book.fee.classwise.get');
    Route::get('/book/fee/payslip',[StudentBookFeeController::class,'BookFeePaySlip'])->name('student.book.fee.payslip');

    //Student T-shirt Fee Route
    Route::get('/t-shirt/fee/view',[StudentTshirtFeeController::class,'StudentTshirtFeeView'])->name('student.t-shirt.fee');
    Route::get('/t-shirt/fee',[StudentTshirtFeeController::class,'StudentTshirtFee'])->name('student.tshirt.fee');
    Route::get('/t-shirt/fee/payslip',[StudentTshirtFeeController::class,'BookFeePaySlip'])->name('student.book.fee.payslip');

    //Student Assessment Fee Route
    Route::get('/assessment/fee/view',[StudentAssessmentFeeController::class,'StudentAssessmentFeeView'])->name('student.assessment.fee');
    Route::get('/assessment/fee',[StudentAssessmentFeeController::class,'StudentAssessmentFee'])->name('student.assessments.fee');
    Route::get('/t-shirt/fee/payslip',[StudentAssessmentFeeController::class,'BookFeePaySlip'])->name('student.book.fee.payslip');

});


    Route::prefix('employee')->group(function (){
        Route::get('/reg/view',[EmployeeRegController::class,'EmployeeRegView'])->name('employee.reg');
        Route::get('/add',[EmployeeRegController::class,'EmployeeAdd'])->name('add.employee');
        Route::post('/store',[EmployeeRegController::class,'EmployeeStore'])->name('store.employee.reg');
        Route::get('/edit/{id}',[EmployeeRegController::class,'EmployeeEdit'])->name('employee.edit');
        Route::post('/update/{id}',[EmployeeRegController::class,'EmployeeUpdate'])->name('update.employee.reg');
        Route::get('/details/{id}',[EmployeeRegController::class,'EmployeeDetails'])->name('employee.details');

        //Employee Salary Route
        Route::get('/salary',[EmployeeSalaryController::class,'EmployeeSalaryView'])->name('employee.salary');
        Route::get('/salary/increment/{id}',[EmployeeSalaryController::class,'EmployeeSalaryIncrement'])->name('employee.salary.increment');
        Route::post('/salary/store/{id}',[EmployeeSalaryController::class,'EmployeeSalaryStore'])->name('store.salary.employee');
        Route::get('salary/details/{id}',[EmployeeSalaryController::class,'EmployeeSalaryDetails'])->name('employee.salary.details');

        //Employee Leave Route
        Route::get('/leave/view',[EmployeeLeaveController::class,'EmployeeLeaveView'])->name('employee.leave');
        Route::get('/leave/Add',[EmployeeLeaveController::class,'EmployeeLeaveAdd'])->name('add.employee.leave');
        Route::post('/leave/store',[EmployeeLeaveController::class,'EmployeeLeaveStore'])->name('store.employee.leave');
        Route::get('/leave/edit/{id}',[EmployeeLeaveController::class,'EmployeeLeaveEdit'])->name('leave.edit');
        Route::post('/leave/update/{id}',[EmployeeLeaveController::class,'EmployeeLeaveUpdate'])->name('update.employee.leave');
        Route::get('/leave/delete/{id}',[EmployeeLeaveController::class,'EmployeeLeaveDelete'])->name('leave.delete');

        //Employee Leave Attendance Route
        Route::get('/attendance/view',[EmployeeAttendanceController::class,'EmployeeAttendanceView'])->name('employee.attendance');
        Route::get('/attendance/Add',[EmployeeAttendanceController::class,'EmployeeAttendanceAdd'])->name('add.employee.attendance');
        Route::post('/attendance/store',[EmployeeAttendanceController::class,'EmployeeAttendanceStore'])->name('store.employee.attendance');
        Route::get('/attendance/edit/{data}',[EmployeeAttendanceController::class,'EmployeeAttendanceEdit'])->name('employee.attendance.edit');
        Route::get('/attendance/details/{data}',[EmployeeAttendanceController::class,'EmployeeAttendanceDetails'])->name('employee.attendance.details');

        //Employee Monthly Salary Route
        Route::get('/monthly/salary/view',[EmployeeMonthlySalaryController::class,'EmployeeMonthlySalaryView'])->name('employee.monthly.salary');
        Route::get('/monthly/salary/get',[EmployeeMonthlySalaryController::class,'EmployeeMonthlySalaryGet'])->name('employee.monthly.salary.get');
        Route::get('/monthly/salary/payslip/{employee_id}',[EmployeeMonthlySalaryController::class,'EmployeeMonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');

    });
    Route::prefix('marks')->group(function () {
        Route::get('/marks/entry/add', [MarksController::class, 'StudentMarksAdd'])->name('student.marks.add');
        Route::post('/marks/entry/store', [MarksController::class, 'StudentMarksStore'])->name('student.marks.store');
        Route::get('/marks/entry/edit', [MarksController::class, 'StudentMarksEdit'])->name('student.marks.edit');
        Route::get('/marks/getstudents/edit', [MarksController::class, 'MarksEditGetStudents'])->name('student.edit.getstudents');

        //Marks Grade Route
        Route::get('/marks/grade/view', [GradeController::class, 'StudentMarksGrade'])->name('student.marks.grade');
        Route::get('/marks/grade/add', [GradeController::class, 'StudentMarksGradeAdd'])->name('add.grade');
        Route::post('/marks/grade/store', [GradeController::class, 'StudentMarksGradeStore'])->name('store.student.grade');
        Route::get('/marks/grade/edit/{id}', [GradeController::class, 'StudentMarksGradeEdit'])->name('employee.edit');
        Route::post('/marks/grade/update/{id}', [GradeController::class, 'StudentMarksGradeUpdate'])->name('update.student.grade');


    });

    Route::prefix('account')->group(function () {
        Route::get('/student/fee/view', [AccountStudentFeeController::class, 'AccountStudentFeeView'])->name('account.student.fee.view');
        Route::get('/student/fee/add', [AccountStudentFeeController::class, 'AccountStudentFeeAdd'])->name('account.add.student.fee');
        Route::get('/student/fee/getStudent', [AccountStudentFeeController::class, 'AccountStudentFeeGetStudent'])->name('account.fee.getStudent');
        Route::post('/student/fee/store', [AccountStudentFeeController::class, 'AccountStudentFeeStore'])->name('account.fee.store');

        // Employee Salary Routes
        Route::get('/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.teacher.fee.view');

        Route::get('/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');

        Route::get('/salary/getemployee', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');

        Route::post('/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');

        // Other Cost Rotues

        Route::get('other/cost/view', [OtherCostController::class, 'OtherCostView'])->name('other.cost.view');

        Route::get('other/cost/add', [OtherCostController::class, 'OtherCostAdd'])->name('other.cost.add');

        Route::post('other/cost/store', [OtherCostController::class, 'OtherCostStore'])->name('store.other.cost');

        Route::get('other/cost/edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('edit.other.cost');

        Route::post('other/cost/update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('update.other.cost');
    });


    //Student Data Manegmant
    Route::prefix('studentData')->group(function () {
        Route::get('/student/all/data/view', [StudentDataController::class, 'StudentDataView'])->name('student.all.data.view');
        Route::get('/student/all/data/add', [StudentDataController::class, 'StudentDataAdd'])->name('student.data.add');
        Route::post('/store/Student/data', [StudentDataController::class, 'StudentDataStore'])->name('store.student.data');
        Route::get('/get-student-data', [StudentDataController::class, 'getStudentData'])->name('get.student.data');
        Route::get('/download-pdf/{id}', [StudentDataController::class, 'downloadPDF'])->name('download.pdf');
    });



    /// Report Management All Routes
    Route::prefix('reports')->group(function(){

        Route::get('monthly/profit/view', [ProfitController::class, 'MonthlyProfitView'])->name('monthly.profit.view');

        Route::get('monthly/profit/datewais', [ProfitController::class, 'MonthlyProfitDatewais'])->name('report.profit.datewais.get');

        Route::get('monthly/profit/pdf', [ProfitController::class, 'MonthlyProfitPdf'])->name('report.profit.pdf');

// MarkSheet Generate Routes
        Route::get('marksheet/generate/view', [MarkSheetController::class, 'MarkSheetView'])->name('marksheet.generate.view');

        Route::get('marksheet/generate/get', [MarkSheetController::class, 'MarkSheetGet'])->name('report.marksheet.get');


//// Attendance Report Routes
//        Route::get('attendance/report/view', [AttenReportController::class, 'AttenReportView'])->name('attendance.report.view');
//
//        Route::get('report/attendance/get', [AttenReportController::class, 'AttenReportGet'])->name('report.attendance.get');
//
//// Student Result Report Routes
//        Route::get('student/result/view', [ResultReportController::class, 'ResultView'])->name('student.result.view');
//
//        Route::get('student/result/get', [ResultReportController::class, 'ResultGet'])->name('report.student.result.get');
//
//// Student ID Card Routes
//        Route::get('student/idcard/view', [ResultReportController::class, 'IdcardView'])->name('student.idcard.view');
//
//        Route::get('student/idcard/get', [ResultReportController::class, 'IdcardGet'])->name('report.student.idcard.get');

    });


    Route::get('/marks/getsubject', [GetSubjectController::class, 'GetSubject'])->name('marks.getsubject');
    Route::get('student/marks/getstudents', [GetSubjectController::class, 'GetStudents'])->name('student.marks.getstudents');


    Route::prefix('teacher')->group(function () {
        Route::get('/lesson/view',[TeacherController::class,'LessonPlanView'])->name('lesson.plan.view');
        Route::get('/lesson/add',[TeacherController::class,'AddLessonPlan'])->name('add.lesson.plan');
        Route::post('/lesson/store',[TeacherController::class,'StoreLessonPlan'])->name('store.lesson.plan');

        Route::get('/daily/activities/view',[TeacherController::class,'DailyActivitiesView'])->name('Daily.activities.view');
        Route::get('/daily/activities/Add',[TeacherController::class,'DailyActivitiesAdd'])->name('add.daily_activities');
        Route::post('/daily/activities/store',[TeacherController::class,'StoreDailyActivities'])->name('store.daily.activities');
        Route::get('/daily-activities/{id}', [TeacherController::class, 'destroy'])->name('delete.daily_activity');
    });
});


Route::middleware(['student'])->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/reg/view',[StudentRegController::class,'StudentRegView'])->name('student.reg');
        Route::get('/reg/add',[StudentRegController::class,'AddStudent'])->name('add.student');
        Route::post('/reg/store',[StudentRegController::class,'StoreRegistration'])->name('store.student.reg');
        //Student Tuition Fee Route
        Route::get('/tuition/fee/view',[StudentTuitionFeeController::class,'StudentTuitionFeeView'])->name('student.tuition.fee');
        Route::get('/tuition/fee/classwiseget',[StudentTuitionFeeController::class,'TuitionFeeClassWiseGet'])->name('student.tuition.fee.classwise.get');
        Route::get('/tuition/fee/payslip',[StudentTuitionFeeController::class,'TuitionFeePaySlip'])->name('student.tuition.fee.payslip');

        //Student Exam Fee Route
        Route::get('/tuition/exam/view',[StudentExampFeeController::class,'StudentExamFeeView'])->name('student.exam.fee');
        Route::get('/tuition/exam/classwiseget',[StudentExampFeeController::class,'ExamFeeClassWiseGet'])->name('student.exam.fee.classwise.get');
        Route::get('/tuition/exam/payslip',[StudentExampFeeController::class,'ExamFeePaySlip'])->name('student.exam.fee.payslip');

        //Student Book Fee Route
        Route::get('/book/fee/view',[StudentBookFeeController::class,'StudentBookFeeView'])->name('student.book.fee');
        Route::get('/book/fee/classwiseget',[StudentBookFeeController::class,'BookFeeClassWiseGet'])->name('student.book.fee.classwise.get');
        Route::get('/book/fee/payslip',[StudentBookFeeController::class,'BookFeePaySlip'])->name('student.book.fee.payslip');

        //Student T-shirt Fee Route
        Route::get('/t-shirt/fee/view',[StudentTshirtFeeController::class,'StudentTshirtFeeView'])->name('student.t-shirt.fee');
        Route::get('/t-shirt/fee',[StudentTshirtFeeController::class,'StudentTshirtFee'])->name('student.tshirt.fee');
        Route::get('/t-shirt/fee/payslip',[StudentTshirtFeeController::class,'BookFeePaySlip'])->name('student.book.fee.payslip');

        //Student Assessment Fee Route
        Route::get('/assessment/fee/view',[StudentAssessmentFeeController::class,'StudentAssessmentFeeView'])->name('student.assessment.fee');
        Route::get('/assessment/fee',[StudentAssessmentFeeController::class,'StudentAssessmentFee'])->name('student.assessments.fee');
        Route::get('/t-shirt/fee/payslip',[StudentAssessmentFeeController::class,'BookFeePaySlip'])->name('student.book.fee.payslip');

//        Route::get('/add/cart', [PaymentController::class, 'StudentCartAdd'])->name('student.add.cart');
//
        Route::get('/product/view', [ProductsController::class, 'index'])->name('product.add.cart');
        Route::get('/product/cart', [ProductsController::class, 'cart'])->name('cart');
        Route::get('/add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('add_to_cart');
        Route::patch('/product/update-cart', [ProductsController::class, 'update'])->name('update_cart');
        Route::delete('/product/remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart');

        Route::get('/payment/view', [PaymentTestController::class, 'paymentView'])->name('student.testPayment.add');




// SSLCOMMERZ Start
        Route::post('/payment', [SslCommerzPaymentController::class, 'initiatePayment'])->name('payment.initiate');
        Route::post('/student/payment/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
        Route::post('/student/payment/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.fail');
        Route::post('/student/payment/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');

//SSLCOMMERZ END
    });
});



//Teacher Role Route Middleware
Route::middleware(['teacher'])->group(function () {
    Route::prefix('teacher')->group(function () {
        Route::get('/lesson/view',[TeacherController::class,'LessonPlanView'])->name('lesson.plan.view');
        Route::get('/lesson/add',[TeacherController::class,'AddLessonPlan'])->name('add.lesson.plan');
        Route::post('/lesson/store',[TeacherController::class,'StoreLessonPlan'])->name('store.lesson.plan');

        Route::get('/daily/activities/view',[TeacherController::class,'DailyActivitiesView'])->name('Daily.activities.view');
        Route::get('/daily/activities/Add',[TeacherController::class,'DailyActivitiesAdd'])->name('add.daily_activities');
        Route::post('/daily/activities/store',[TeacherController::class,'StoreDailyActivities'])->name('store.daily.activities');
        Route::get('/daily-activities/{id}', [TeacherController::class, 'destroy'])->name('delete.daily_activity');


    });
});
