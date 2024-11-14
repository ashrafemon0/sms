@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
 @endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="../images/logo-dark.png" alt="">
                        <h3><b>Learning</b> Tree</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{($route == 'dashboard')?'active':''}}">
                <a href="{{route('dashboard')}}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->role == 'admin')
                <li class="treeview {{($prefix == '/user')?'active':''}}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Manage User</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('user.view')}}"><i class="ti-more"></i>View User</a></li>
                        <li><a href="{{route('add.user')}}"><i class="ti-more"></i>Add User</a></li>
                    </ul>
                </li>
            @endif
            <li class="treeview {{($prefix == '/profile')?'active':''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Manage Profile</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('user.profile')}}"><i class="ti-more"></i>View Profile</a></li>
                    <li><a href="{{route('change.password')}}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>
            @if(Auth::user()->role == 'admin')
            <li class="treeview {{($prefix == '/setup')?'active':''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Student Setup</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('student.class')}}"><i class="ti-more"></i>Student Class</a></li>
                    <li><a href="{{route('student.year')}}"><i class="ti-more"></i>Student Year</a></li>
                    <li><a href="{{route('student.group')}}"><i class="ti-more"></i>Student Group</a></li>
                    <li><a href="{{route('student.shift')}}"><i class="ti-more"></i>Student Shift</a></li>
                    <li><a href="{{route('student.feeCategory')}}"><i class="ti-more"></i>Fee Category</a></li>
                    <li><a href="{{route('student.feeCategoryAmount')}}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li><a href="{{route('student.exam')}}"><i class="ti-more"></i>Exam Type</a></li>
                    <li><a href="{{route('student.subject')}}"><i class="ti-more"></i>Subject</a></li>
                    <li><a href="{{route('subject.assign')}}"><i class="ti-more"></i>Subject Assign</a></li>
                    <li><a href="{{route('designation')}}"><i class="ti-more"></i>Designation</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->role == 'admin')
            <li class="treeview {{($prefix == '/student')?'active':''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Student Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('student.reg')}}"><i class="ti-more"></i>Student Registration</a></li>

                    <li><a href="{{route('student.roll.generate')}}"><i class="ti-more"></i>Student Roll Generate</a></li>
                    <li><a href="{{route('student.registration.fee')}}"><i class="ti-more"></i>Registration Fee</a></li>
                    <li><a href="{{route('student.tuition.fee')}}"><i class="ti-more"></i>Tuition Fee</a></li>
                    <li><a href="{{route('student.book.fee')}}"><i class="ti-more"></i>Book Fee</a></li>
                    <li><a href="{{route('student.t-shirt.fee')}}"><i class="ti-more"></i>T-Shirt Fee</a></li>
                    <li><a href="{{route('student.assessment.fee')}}"><i class="ti-more"></i>Assessment Fee</a></li>
                    <li><a href="{{route('student.exam.fee')}}"><i class="ti-more"></i>Exam Fee</a></li>
                </ul>
            </li>

            @endif
            @if(Auth::user()->role == 'student')
                <li class="treeview {{($prefix == '/student')?'active':''}}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Student Management</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('student.reg')}}"><i class="ti-more"></i>Student Registration</a></li>
                        <li><a href="{{route('student.registration.fee')}}"><i class="ti-more"></i>Registration Fee</a></li>
                        <li><a href="{{route('student.tuition.fee')}}"><i class="ti-more"></i>Tuition Fee</a></li>
                        <li><a href="{{route('student.book.fee')}}"><i class="ti-more"></i>Book Fee</a></li>
                        <li><a href="{{route('student.t-shirt.fee')}}"><i class="ti-more"></i>T-Shirt Fee</a></li>
                        <li><a href="{{route('student.assessment.fee')}}"><i class="ti-more"></i>Assessment Fee</a></li>
                        <li><a href="{{route('student.exam.fee')}}"><i class="ti-more"></i>Exam Fee</a></li>

                    </ul>
                </li>
            @endif
            @if(Auth::user()->role == 'admin')
            <li class="treeview {{($prefix == '/employee')?'active':''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Employee Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('employee.reg')}}"><i class="ti-more"></i>Employee Registration</a></li>
                    <li><a href="{{route('employee.salary')}}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li><a href="{{route('employee.leave')}}"><i class="ti-more"></i>Employee Leave</a></li>
                    <li><a href="{{route('employee.attendance')}}"><i class="ti-more"></i>Employee Attendance</a></li>
                    <li><a href="{{route('employee.monthly.salary')}}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->role == 'admin')
            <li class="treeview {{($prefix == '/marks')?'active':''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Marks Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('student.marks.add')}}"><i class="ti-more"></i>Marks Adds</a></li>
                    <li><a href="{{route('student.marks.edit')}}"><i class="ti-more"></i>Marks Edit</a></li>
                    <li><a href="{{route('student.marks.grade')}}"><i class="ti-more"></i>Marks grade</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->role == 'admin')
            <li class="treeview {{($prefix == '/account')?'active':''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Account Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('account.student.fee.view')}}"><i class="ti-more"></i>Student Fee</a></li>
                    <li><a href="{{route('account.teacher.fee.view')}}"><i class="ti-more"></i>Teacher Fee</a></li>
                    <li><a href="{{route('other.cost.view')}}"><i class="ti-more"></i>Other Cost</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->role == 'admin')
                <li class="treeview {{($prefix == '/studentData')?'active':''}}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Student Data</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('student.all.data.view')}}"><i class="ti-more"></i>Student All Data</a></li>
                        <li><a href="{{route('student.data.add')}}"><i class="ti-more"></i>Student Add Data</a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->role == 'admin')
                <li class="treeview {{($prefix == '/teacher')?'active':''}}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Teacher Management</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('lesson.plan.view')}}"><i class="ti-more"></i>Lesson Plan</a></li>
                        <li><a href="{{route('Daily.activities.view')}}"><i class="ti-more"></i>Daily Activities</a></li>

                    </ul>
                </li>


            <li class="treeview ">
                <a href="#">
                    <i data-feather="mail"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
                    <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
                    <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
                </ul>
            </li>

            @endif
            @if(Auth::user()->role == 'teacher')
                <li class="treeview {{($prefix == '/teacher')?'active':''}}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Teacher Management</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('lesson.plan.view')}}"><i class="ti-more"></i>Lesson Plan</a></li>
                        <li><a href="{{route('Daily.activities.view')}}"><i class="ti-more"></i>Daily Activities</a></li>

                    </ul>
                </li>
            @endif
            <li class="header nav-small-cap">User Interface</li>

            @if(Auth::user()->role == 'admin')
                <li class="treeview {{($prefix == '/report')?'active':''}}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Report Management</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ ($route == 'monthly.profit.view')?'active':'' }}"><a href="{{ route('monthly.profit.view') }}"><i class="ti-more"></i>Monthly-Yearly Profite</a></li>

{{--                        <li class="{{ ($route == 'marksheet.generate.view')?'active':'' }}"><a href="{{ route('marksheet.generate.view') }}"><i class="ti-more"></i>MarkSheet Generate</a></li>--}}

{{--                        <li class="{{ ($route == 'attendance.report.view')?'active':'' }}"><a href="{{ route('attendance.report.view') }}"><i class="ti-more"></i>Attendance Report</a></li>--}}

{{--                        <li class="{{ ($route == 'student.result.view')?'active':'' }}"><a href="{{ route('student.result.view') }}"><i class="ti-more"></i>Student Result </a></li>--}}

{{--                        <li class="{{ ($route == 'student.idcard.view')?'active':'' }}"><a href="{{ route('student.idcard.view') }}"><i class="ti-more"></i>Student ID Card </a></li>--}}



                    </ul>
                </li>
            @endif


        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
