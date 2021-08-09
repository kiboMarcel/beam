<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
        }

        body h2 {
            text-align: center;
        }

        .header p {
            margin: 4px, 0px;
        }

        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 70px;

        }

        .text {
            float: left;
            width: 40%;
        }

        .logo {
            float: right;
            width: 15%;
        }

        img {
            width: 100px;
        }

      
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .student-data {
            text-align: center;
        }

     

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

    </style>


</head>
@php
$date = date('Y-m', strtotime($details[0]->date));
 if($date != ''){
    $where[] =  ['date', 'like', $date.'%'];
}

$totalattend = App\Models\EmployeeAttendance::with(['user'])->where($where)
        ->where('employee_id',$details[0]->employee_id)->get();
        
        $absentcount = count($totalattend->where('attend_status', 'absent'));
        $salary = (float)$details[0]['user']['salary'];
        $salaryPerDay = $salary/30;
        $totalSalaryMinus = (float)$absentcount * (float)$salaryPerDay;
        $totalSalary = (float)$salary - (float)$totalSalaryMinus;
        $round = round($totalSalary, 2) ;
@endphp

<body>

  <div>
    <div class="header">
        <div class="text">
            <h3>College Moderne Le JOURDAIN</h3>
            <p>Adresse: bo 42</p>
            <p>Telephone; 75 64 78 96</p>
            <p>Email: nouletamemarcel@gmail.com</p>

        </div>

        <div class="logo">
            <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
        </div>
    </div>


    <h2> Salaire du mois </h2>
    <table class="styled-table" id="customers">
        <thead>
            <tr>
                <th style="width: 300px"><strong>Detail</strong></th>
                <th style="width: 300px"><strong>Employee</strong></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <h4>nom</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire Basic</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['salary'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Absence Totale</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $absentcount }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>mois</h4>
                </td>
                <td class="student-data">
                    <strong> {{ date('m-Y', strtotime($date)) }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire du mois</h4>
                </td>
                <td class="student-data">
                    <strong> {{  $round }} </strong>
                </td>
            </tr>
          

        </tbody>
    </table>

    <i style="font-size: 10px; float: right; margin-top: 10px"> print date: {{ date("d-m-Y") }} </i>

    <hr style="border: dashed 2px; width: 95%; color:#0000; margin: 30px 0" >

  </div>
    
  <div>
    <div class="header">
        <div class="text">
            <h3>College Moderne Le JOURDAIN</h3>
            <p>Adresse: bo 42</p>
            <p>Telephone; 75 64 78 96</p>
            <p>Email: nouletamemarcel@gmail.com</p>

        </div>

        <div class="logo">
            <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
        </div>
    </div>


    <h2> Salaire du mois </h2>
    <table class="styled-table" id="customers">
        <thead>
            <tr>
                <th style="width: 300px"><strong>Detail</strong></th>
                <th style="width: 300px"><strong>Employee</strong></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <h4>nom</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire Basic</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['salary'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Absence Totale</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $absentcount }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>mois</h4>
                </td>
                <td class="student-data">
                    <strong> {{ date('m-Y', strtotime($date)) }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire du mois</h4>
                </td>
                <td class="student-data">
                    <strong> {{  $round }} </strong>
                </td>
            </tr>
          

        </tbody>
    </table>

    <i style="font-size: 10px; float: right; margin-top: 5px"> print date: {{ date("d-m-Y") }} </i>

   

  </div>
    
</body>

</html>
