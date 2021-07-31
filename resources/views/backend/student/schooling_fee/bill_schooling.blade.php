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
            <h3>College Moderne Le JOURDAIN</h3>
            <p>Adresse: bo 42</p>
            <p>Telephone; 75 64 78 96</p>
            <p>Email: nouletamemarcel@gmail.com</p>
            <p>Année: {{$allData[0]->student_year->name}}</p>

        </div>

        <div class="logo">
            <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
        </div>
    </div>


    <h2>Liste de Presence </h2>
    <h3> </h3>

    <table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>
            <tr>
                <td style="width: 50%; text-align: center;">Nom Prenom</td>
                <td style="width: 50.0975%; text-align: center;" colspan="7">Presence</td>
            </tr>
            @foreach ($allData as $item)
            <tr>
                <td style="width: 50%;">  </td>
                <td style="width: 6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
                <td style="width: 6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
                <td style="width: 6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>

</body>

</html>
