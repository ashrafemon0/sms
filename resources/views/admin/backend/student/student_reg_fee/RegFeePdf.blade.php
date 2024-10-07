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
    @php
        $registrationFee = App\Models\StudentFeeCategoryAmount::where('fee_category_id','1')->where('class_id',$details->class_id)->first();
           $originalFee = (float)$registrationFee->fee_category_amount;
                   $discount = (float)$details['discount']['discount'];
                   $discountableFee = $discount/100*$originalFee;
                   $finalFee = $originalFee-$discountableFee;
    @endphp
    <tr>
        <th><h2>Learning Tree School</h2></th>
        <th>
            <h2>School ERP</h2>
            <p><b>Address: Mirpur DOSH Avenue 11, Road 10,House 1182</b></p>
            <p><b>Phone: 01785753485</b></p>
            <p><b>Email:emon@gmail.com</b></p>
        </th>
        <th></th>
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
        <td>Registration Fee</td>
        <td>{{$originalFee}}</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Discount Fee</td>
        <td>{{$discount}}</td>
    </tr>
    <tr>
        <td>9</td>
        <td>Final Student Fee</td>
        <td>{{$finalFee}}</td>
    </tr>
    <tr>
        <td>10</td>
        <td>Birth Date</td>
        <td>{{$details['student']['dob']}}</td>
    </tr>
    <tr>
        <td>11</td>
        <td>Class</td>
        <td>{{$details['student_class']['name']}}</td>
    </tr>
    <tr>
        <td>12</td>
        <td>Year</td>
        <td>{{$details['student_year']['year']}}</td>
    </tr>
    <tr>
        <td>13</td>
        <td>Group</td>
        <td>{{$details['s_group']['group']}}</td>
    </tr>
    <tr>
        <td>14</td>
        <td>Shift</td>
        <td>{{$details['s_shift']['shift']}}</td>
    </tr>

</table>
<br> <br>
<i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
</body>
</html>

