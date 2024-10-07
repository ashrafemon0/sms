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
    @php
        $registrationFee = App\Models\StudentFeeCategoryAmount::where('fee_category_id','2')->where('class_id',$details->class_id)->first();
           $originalFee = (float)$registrationFee->fee_category_amount;
    @endphp
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
<table>
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
        <td>2</td>
        <td>Student ID No</td>
        <td>{{$details['student']['id_no']}}</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Student Roll</td>
        <td>{{$details->roll}}</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Father Name</td>
        <td>{{$details['student']['fname']}}</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Mother Name</td>
        <td>{{$details['student']['mname']}}</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Mobile</td>
        <td>{{$details['student']['mobile']}}</td>
    </tr>
    <tr>
        <td>7</td>
        <td>Tuition Fee</td>
        <td>{{$originalFee}}</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Birth Date</td>
        <td>{{$details['student']['dob']}}</td>
    </tr>
    <tr>
        <td>9</td>
        <td>Class</td>
        <td>{{$details['student_class']['name']}}</td>
    </tr>
    <tr>
        <td>10</td>
        <td>Year</td>
        <td>{{$details['student_year']['year']}}</td>
    </tr>
    <tr>
        <td>11</td>
        <td>Group</td>
        <td>{{$details['s_group']['group']}}</td>
    </tr>
    <tr>
        <td>12</td>
        <td>Shift</td>
        <td>{{$details['s_shift']['shift']}}</td>
    </tr>
    <tr>
        <td>7</td>
        <td>This is {{$month}} Month Tuition Fee</td>
        <td>{{$originalFee}}</td>
    </tr>

</table>
<br> <br>
<i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
</body>
</html>

