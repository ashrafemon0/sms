<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>Student Payment Slip</h2>

<table>

    <tr>
        <td><h2>
                <?php $image_path = '/upload/Lt.png'; ?>
                <img src="{{ public_path() . $image_path }}" width="200" height="100">

            </h2></td>


        <td><h2>Learning Tree School</h2>
            <p>School Address</p>
            <p>Phone : 01316587536</p>
            <p>Email : admin@learningtreebd.org</p>
            <p> <b> Student Monthly Fee</b> </p>
        </td>
    </tr>
</table>

@php

    $date = date('Y-m',strtotime($details['0']->date));

            if ($date != ''){
                $where[] = ['date','like',$date.'%'];
            }
               $totalAttend = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$details['0']->employee_id)->get();

            $salary = (float)$details['0']['user']['salary'];
            $perDaySalary = (float)$salary/30;
             $absentCount = count($totalAttend->where('atten_status','Absent'));
            $totalSalaryMinus = (float)$absentCount*(float)$perDaySalary;
            $TotalSalary = (float)$salary-(float)$totalSalaryMinus;

@endphp



<table>
    <tr>
        <th width="10%">SL</th>
        <th width="45%">Employee Details</th>
        <th width="45%">Employee Data</th>
    </tr>
    <tr>
        <td>1</td>
        <td><b>Employee Name</b></td>
        <td>{{ $details['0']['user']['name'] }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td><b>Basic Salary</b></td>
        <td>{{ $details['0']['user']['salary'] }}</td>
    </tr>

    <tr>
        <td>3</td>
        <td><b>Total Absent for This Month</b></td>
        <td>{{ $absentCount }}</td>
    </tr>

    <tr>
        <td>4</td>
        <td><b>Month</b></td>
        <td>{{ date('M Y',strtotime($details['0']->date)) }}</td>
    </tr>
    <tr>
        <td>5</td>
        <td><b>Salary This Month</b></td>
        <td>{{ $TotalSalary }}</td>
    </tr>


</table>
<br> <br>


<table>
    <tr>
        <th width="10%">SL</th>
        <th width="45%">Employee Details</th>
        <th width="45%">Employee Data</th>
    </tr>
    <tr>
        <td>1</td>
        <td><b>Employee Name</b></td>
        <td>{{ $details['0']['user']['name'] }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td><b>Basic Salary</b></td>
        <td>{{ $details['0']['user']['salary'] }}</td>
    </tr>

    <tr>
        <td>3</td>
        <td><b>Total Absent for This Month</b></td>
        <td>{{ $absentCount }}</td>
    </tr>

    <tr>
        <td>4</td>
        <td><b>Month</b></td>
        <td>{{ date('M Y',strtotime($details['0']->date)) }}</td>
    </tr>
    <tr>
        <td>5</td>
        <td><b>Salary This Month</b></td>
        <td>{{ $TotalSalary }}</td>
    </tr>


</table>

<br> <br>
<i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
</body>
</html>

