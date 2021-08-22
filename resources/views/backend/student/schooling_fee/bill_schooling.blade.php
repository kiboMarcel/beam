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


        .signature  {
            float: right;
            margin-top: 12px;
            margin-left: 500px;
        }

        .paid {
            float: right;
            margin-left: 100px;
        }

        

        .student-data {
            text-align: center;
        }


        h3{
            font-weight: lighter;
        }

    </style>


</head>

<body>
    <div>
        <div class="header">
            <div class="text">
                <h3> {{$school_info== null? '': $school_info->name }} </h3>
                <p>Adresse: {{$school_info== null? '': $school_info->Address  }} 
                     {{$school_info== null? '': $school_info->distric}}</p>
                <p>Telephone:  {{$school_info == null? '': $school_info->num}} </p>
                <p>Année: {{$student['student_year']['name']}}</p>
    
            </div>
    
            <div class="logo">
              <img src=" {{ 
                    (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image.'jpg')
                    : public_path('upload/school_image/no_image.jpg') }}" alt="">
            </div>
        </div>
    
        <h2 >Ecollage </h2>
    
         <h3> Nom: <strong>  {{$student['student']['name']}} </strong> </h3>
        <h3> Classe: <strong> {{$student['student_class']['name']}} {{$student['student_branch']['name']}}
             {{$student['student_group']['name']}} </strong> </h3>
        <h3> la Somme de : <strong> {{ $paying }}  Cfa</strong></h3>
        <h3> Deja payer: <strong> {{ $get_paid_fee->payed }} cfa</strong></h3>
        @if ($schoolingfee->amount - $get_paid_fee->payed == 0 )
            <h3>Soldé</h3>
        @else   
        <h3> Reste a payer: <strong> {{ $schoolingfee->amount - $get_paid_fee->payed }} cfa</strong></h3>
        @endif
    
        <div style="margin-bottom: 18px">
            <div class="signature">
                <span > Signature </span>
                 </div>
            <div class="paid">
                <span >Payé le <span style="font-size: 10px;  margin-top: 10px"> {{ date("d-m-Y") }}</span> </span>
           
            </div>
        </div>
    </div>


<hr  style="border:dashed 2px; width: 95%; color:#0000; margin: 30px 0" >

    <div>
        <div class="header">
            <div class="text">
                <h3>College Moderne Kibo</h3>
                <p>Adresse: bo 42</p>
                <p>Telephone; 75 64 78 96</p>
                <p>Email: nouletamemarcel@gmail.com</p>
                <p>Année: {{$student['student_year']['name']}}</p>
    
            </div>
    
            <div class="logo">
                <img src=" {{ 
                    (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image.'jpg')
                    : public_path('upload/school_image/no_image.jpg') }}" alt="">
            </div>
        </div>
    
    
        <h2>Ecollage </h2>
        <h3> </h3>
    
         <h3> Nom: <strong>  {{$student['student']['name']}} </strong> </h3>
        <h3> Classe: <strong> {{$student['student_class']['name']}} {{$student['student_branch']['name']}}
             {{$student['student_group']['name']}} </strong> </h3>
        <h3> la Somme de : <strong> {{ $paying }}  Cfa</strong></h3>
        <h3> Deja payer: <strong> {{ $get_paid_fee->payed }} cfa</strong></h3>
    
        @if ($schoolingfee->amount - $get_paid_fee->payed == 0 )
            <h3>Soldé</h3>
        @else   
        <h3> Reste a payer: <strong> {{ $schoolingfee->amount - $get_paid_fee->payed }} cfa</strong></h3>
        @endif
        <div>
            <div class="signature">
                <span > Signature </span>
                 </div>
            <div class="paid">
                <span >Payé le <span style="font-size: 10px;  margin-top: 10px"> {{ date("d-m-Y") }}</span> </span>
           
            </div>
        </div>
        
    </div>
    

</body>

</html>
