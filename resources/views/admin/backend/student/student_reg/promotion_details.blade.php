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

<h2>Student Details</h2>

<table>
    <tr>
        <th><h2>Learning Tree School</h2></th>
        <th>
            <h2>School ERP</h2>
            <p><b>Address: Mirpur DOSH Avenue 11, Road 10,House 1182</b></p>
            <p><b>Phone: 01785753485</b></p>
            <p><b>Email:emon@gmail.com</b></p>
        </th>
    </tr>
    <tr>
        <th width="10%">SL</th>
        <th width="45%">Student Details</th>
        <th width="45%">Student Data</th>
    </tr>

    <tr>
        <td>1</td>
        <td>Student Name</td>
        <td>{{$details['student']['name']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Student ID No</td>
        <td>{{$details['student']['roll']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Student Roll</td>
        <td>{{$details['student']['id_no']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Father Name</td>
        <td>{{$details['student']['fname']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Mother Name</td>
        <td>{{$details['student']['mname']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Mobile</td>
        <td>{{$details['student']['mobile']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Address</td>
        <td>{{$details['student']['address']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Gender</td>
        <td>{{$details['student']['gender']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Religion</td>
        <td>{{$details['student']['religion']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Birth Date</td>
        <td>{{$details['student']['dob']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Discount</td>
        <td>{{$details['discount']['discount']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Class</td>
        <td>{{$details['student_class']['name']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Year</td>
        <td>{{$details['student_year']['year']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Group</td>
        <td>{{$details['s_group']['group']}}</td>
    </tr>
    <tr>
        <td>1</td>
        <td>Shift</td>
        <td>{{$details['s_shift']['shift']}}</td>
    </tr>

</table>
<br> <br>
<i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
</body>
</html>

