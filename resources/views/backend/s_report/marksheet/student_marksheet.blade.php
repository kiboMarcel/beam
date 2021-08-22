<!DOCTYPE html>
<html>

<head>
    <style>
        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 20px;

        }

        .text-div {
            float: right;
        }

        .text-div h5,  h6 {            
            font-weight: lighter;
            font-size: 12px;
            padding-left: 12px;
            padding-top: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .logo {
            float: left;
            width: 15%;
        }

        .logo-right {
            float: right;
            text-align: center;
            width: 25%;
        }

        body {
            font-family: sans-serif;
           /*  background-color: #CFB077; */
        }

        .season_div{
            margin: 0 80px 0 100px;
            border: 2px solid blueviolet;
            padding: 5px;
        }

        body .season_name {
            padding-top: 20px; 
            font-size: 23px;
            font-weight: bold;
        }

        .detail {
            float: right;
            float: left;
            width: 15%;
            margin-top:20px;
            margin-bottom:20px;
        }

        .detail h5,  h6 {
            
            font-weight: lighter;
            font-size: 12px;
            padding-left: 12px;
            padding-top: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .student-info {
            float: right;
        }

        .student-info h5,  h6 {     
            font-weight: lighter;
            font-size: 12px;
            padding-left: 12px;
            padding-top: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .location {
            float: right;
            text-align: center;
            width: 70%;
        }

      
        body h3 {
            font-weight: lighter;
            margin-bottom: 5px;
            text-align: center;
        }

        body h4 {
            font-weight: lighter;
        }

        img {
            width: 100px;
        }


        tr,
        td {
            border: 1px solid black;
        }

        table,
        tr,
        td {
            border-collapse: collapse;
        }


        .border_style {
            border: none !important;
        }

        .border_style td {
            border: none !important;
        }

        .total_style {
            border-bottom: 1px solid black;
            border-left: none;
        }

        .td-text {
            text-align: center;
        }

        .tr-space {
            margin-left: 42px;
        }

        .observation_td {
            font-size: 12px;
        }
   

        .habit{
            float: left;
            width: 15%;
        }

        .rank  {
            float: right;
            margin-top: 12px;
            margin-left: 500px;
        }

        .season-avg {
            float: right;
            margin-left: 100px;
        }

        .final-avg{
            border: 1px solid gray;
            padding: 5px;
            width: 7%;
            display: inline-block;
        }

        .final-avg strong{
        }

    </style>

</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="{{ 
                (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image.'jpg')
                : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>

        <div class="logo-right">
           <h6> REPUBLIQUE TOGOLAISE</h6>
           <h6> travail-liberté-patrie</h6>
        </div>

        <div class="text-div">

            <h6> <strong>{{$school_info== null? '': $school_info->name }}</strong> </h6>

            <h6> {{$school_info== null? '': $school_info->Address  }}
                {{$school_info== null? '': $school_info->distric}}
                {{$school_info == null? '': $school_info->num}}</h6>
            <h6>Lomé-Togo</h6>
        </div>

    </div>

    <div class="season_div">
        <span class="season_name"> BULLETIN DE NOTE DU <strong> {{ $marks['0']['season']['name'] }}</strong>
             Trimestre   <strong> {{ $marks['0']['student_year']['name'] }}</strong> </span>
    </div>

    <div class="">
     
        <div class="detail">
            <h5>N mat:   </h5>
            <h5>Nom Prenom:   </h5>
            <h5>Né le:  </h5>
            <h5>Sexe:    </h5>
            <h5>Classe:  </h5>
        </div>

        <div class="location">
           <h6> Lieu : <strong> {{$school_info->distric}} </strong> </h6>
          
        </div>

        <div class="student-info">
            <div class="student-info">
                <h5>   <strong>     {{ $marks['0']['student']['id_no'] }} </strong> </h5>
                <h5> <strong>  {{ $marks['0']['student']['name'] }}  </strong> </h5>
                <h5> <strong>  {{ $marks['0']['student']['date_of_birth'] }}  </strong> </h5>
                <h5><strong> {{ $marks['0']['student']['gender'] }} </strong> </h5>
                <h5>  <strong>{{$marks['0']['student_class']['name'] }} 
                     {{ $marks['0']['student_branch']['name'] }}  {{ $marks['0']['student_group']['name'] }} </strong>
                </h5>
        
            </div>
        </div>

       
    </div>

   
   {{--  <h4>
        Effectif: <strong> {{ $totalStudent }}  </strong> 
    </h4>
 --}}

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 15%;" rowspan="2" class="td-text">Matières</td>
                <td style="width: 15%;" colspan="4" class="td-text">Note sur 20</td>
                <td style="width: 5%;" rowspan="2" class="td-text">Coef</td>
                <td style="width: 10%;" rowspan="2" class="td-text">Moyenne</td>
                <td style="width: 10%;" rowspan="2" class="td-text">Rangs</td>
                <td style="width: 15%;" rowspan="2" class="td-text">Observation</td>
                <td style="width: 20%;" rowspan="2" class="td-text">Nom et signature des Professeurs</td>
            </tr>

            <tr>
                <td class="td-text"> Intero</td>
                <td class="td-text">Devoir</td>
                <td class="td-text">Compo</td>
                <td class="td-text">Moye</td>
            </tr>

            

            <tr class="border_style">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="td-text" colspan="2">TOTAL</td>
                <td class="td-text"> {{ $coefSum }} </td>
                <td class="td-text"> {{ $seasonAvg }} </td>
                {{-- <td class="td-text"> {{ $marks_avg->final_avg }} </td> --}}
                

            </tr>


     
        </tbody>


    </table>

    <div>
        <div class="habit">
            <span> Retards: {{$student_attendance->retard}} </span><br>
            <span>Abscences: {{$student_attendance->absence}}  </span><br>
            <span>Punitions: {{$student_attendance->punition}}</span><br>
        </div>

        <div class="rank">
            <span>  Moyenne la plus forte de la classe / 20: <strong>{{ $marks_avg_max}}</strong>  </span> <br>
            <span>  Moyenne la plus failbe de la classe / 20: <strong>  {{ $marks_avg_min}}</strong> </span> <br>
            <span>  Moyenne generale de la classe / 20: <strong>{{ $class_avg}}</strong> </span>
        </div>

        <div class="season-avg">
            <span> <strong> Moyenne Generale du Trimestre</strong>  </span>
            <span >  <strong> {{ $marks_avg->final_avg }}  </strong>  </span> <br>    
            <span >  Rang   </span>
            <span > <strong>{{ $student_rank }} </strong > sur  <strong> {{ $totalStudent }}  </strong>  Eleves classés </span>
                
        </div>
      
    </div>
    <hr>
    <div>
        <div class="habit">
          
            <span></span><br>
        </div>

        <div class="rank">
           
            <span> <strong>Observations générales du Conseil de Classe</strong>  </span>
        </div>

        <div class="season-avg">
            <span> Le Directeur </span>
        </div>
      
    </div>





</body>

</html>
