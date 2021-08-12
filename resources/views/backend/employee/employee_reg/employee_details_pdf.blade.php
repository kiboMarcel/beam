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


<body>

    <div class="header">
        <div class="text">
            <h3>College Moderne Kibo</h3>
            <p>Adresse: bo 42</p>
            <p>Telephone; 75 64 78 96</p>
            <p>Email: nouletamemarcel@gmail.com</p>

        </div>

        <div class="logo">
            <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
        </div>
    </div>


    <h2>Information </h2>
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
                    <strong> {{ $details->name }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>No ID</h4>
                </td>
                <td class="student-data">
                    <strong> {{  $details->id_no }} </strong>
                </td>
            </tr>
           
            <tr>
                <td>
                    <h4>Fonction</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details['designation']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Adresse</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details->address }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>sexe</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details->gender }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>nationalité</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details->nationality  }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>annee de naissance</h4>
                </td>
                <td class="student-data">
                    <strong> {{  date('d-m-Y', strtotime( $details->date_of_birth) ) }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Numeros de Telephone</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details->mobile  }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Debut service </h4>
                </td>
                <td class="student-data">
                    <strong> {{ date('d-m-Y', strtotime( $details->join_date) )  }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>nom du père</h4>
                </td>
                <td class="student-data">
                    <strong>{{ $details->fname }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>nom de la mère</h4>
                </td>
                <td class="student-data">
                    <strong>{{ $details->mname }} </strong>
                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>
