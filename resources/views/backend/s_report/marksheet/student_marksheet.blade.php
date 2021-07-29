<!DOCTYPE html>
<html>

<head>
    <style>
        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 50px;

        }

        .text-div {
            float: right;
        }

        .text-div h1 {
            text-align: center;
            margin-bottom: 0;
        }

        .text-div h5 {
            text-align: center;
            font-weight: lighter;
            font-size: 12px;
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
            width: 15%;
        }

        body {
            font-family: sans-serif;
        }

        body h2,
        h3 {
            text-align: center;
        }

        body h3 {
            font-weight: lighter;
            margin-bottom: 5px;
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

    </style>

</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
        </div>

        <div class="logo-right">
            <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
        </div>

        <div class="text-div">
            <h1>College Moderne Le JOURDAIN</h1>
            <h5>Adresse: bo 42 - Telephone: 75 64 78 96 - Email: nouletamemarcel@gmail.com</h5>
            <h5><strong>Prier-Travailler-Reussir</strong></h5>


        </div>

    </div>


    <h2>BULLETIN D'EVALUATION </h2>
    <h3> ELEVE: <strong> {{ $marks['0']['student']['name'] }}</strong> </h3>
    <hr>
    <h4>
        Année-Scolaire: <strong> {{ $marks['0']['student_year']['name'] }}</strong> -
        Trimestre: <strong> {{ $marks['0']['season']['name'] }}</strong>
    </h4>


    {{-- MARKS GET BY SUBJECT START --}}

    {{-- @foreach ($subjects as $subject)
        @php
            $marksBysubjectDevoir = App\Models\StudentMarks::where('assign_subject_id', $subject->id)->
            where('exam_type_id', '1')->get();
            
            $marksBysubjectExam = App\Models\StudentMarks::where('assign_subject_id', $subject->id)->
            where('exam_type_id', '2')->get();
            
        @endphp
        {{ $subject['school_subject']['name'] }}:
        @php
            dd($marksBysubjectExam);
        @endphp
        @foreach ($marksBysubject as $mark)
            {{ $mark->marks }}

        @endforeach <br>
    @endforeach
    {{-- MARKS GET BY SUBJECT END --}}










    {{-- @foreach ($subjects as $subject)
        @php
            $marksBysubjectDevoir = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                ->where('exam_type_id', '1')
                ->get();
            
            $marksBysubjectExam = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                ->where('exam_type_id', '2')
                ->get();
            
        @endphp
        {{ $subject['school_subject']['name'] }}:

        @foreach ($marksBysubjectDevoir as $Devoirmark)
            {{ $mark->Devoirmark }}

        @endforeach <br>
    @endforeach --}}






    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 15%;" rowspan="2" class="td-text">Matières</td>
                <td style="width: 15%;" colspan="4" class="td-text">Note</td>
                <td style="width: 6%;" rowspan="2" class="td-text">M. Cla sur 20</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Compo sur 20</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Moy. sur 20</td>
                <td style="width: 3%;" rowspan="2" class="td-text">Coef</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Notes Def</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Rangs</td>
                <td style="width: 15%;" rowspan="2" class="td-text">Nom des Professeurs</td>
                <td style="width: 15%;" rowspan="2" class="td-text">Observation</td>
                <td style="width: 7%;" rowspan="2" class="td-text">Signature</td>
            </tr>

            <tr>
                <td class="td-text" colspan="4">Divers Devoirs</td>
            </tr>

            @foreach ($subjects as $subject)

                @php
                    $marksBysubjectDevoir = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                        ->where('exam_type_id', '1')
                        ->get();
                    
                    $marksByDevoirAVG = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                        ->where('exam_type_id', '1')
                        ->avg('marks');
                    
                    $marksBysubjectExam = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                        ->where('exam_type_id', '2')
                        ->first();
                @endphp

                {{-- SUBJECT NAME --}}
                <tr>
                    <td> {{ $subject['school_subject']['name'] }}</td>
                </tr>

                {{-- DEVOIR MARKS START --}}
                @php
                    $devoirmark_count = count($marksBysubjectDevoir);
                @endphp

                @foreach ($marksBysubjectDevoir as $Devoirmark)

                    <td style="width: 3.75%;" class="td-text"> {{ $Devoirmark->marks }}</td>

                @endforeach
                
                @if ($devoirmark_count == 1)
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>

                @endif
                @if ($devoirmark_count == 2)
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>

                @endif
                @if ($devoirmark_count == 3)
                    <td style="width: 3.75%;" class="td-text"></td>
                @endif
                {{-- DEVOIR MARKS END --}}

                {{-- DEVOIR AVG START --}}
                <td style="width: 3.75%;" class="td-text">{{ $marksByDevoirAVG }}</td>
                {{-- DEVOIR AVG END --}}

                {{-- EXAM MARKS START --}}
                @if ($marksBysubjectExam == null)
                    <td style="width: 3.75%;" class="td-text"> 0 </td>
                @else

                    <td style="width: 3.75%;" class="td-text"> {{ $marksBysubjectExam->marks }}</td>
                @endif
                {{-- EXAM MARKS END --}}

                {{-- TOTAL AVERAGE EXAM + DEVOIR AVERAGE START --}}
                @php
                if ($marksBysubjectExam == null) {

                    $totalAVG = $marksByDevoirAVG/2;
                } else {
                    $totalAVG = ($marksBysubjectExam->marks + $marksByDevoirAVG)/2; 
                }
                
                @endphp

                <td style="width: 3.75%;" class="td-text">  {{ $totalAVG }}</td>
                {{-- TOTAL AVERAGE EXAM + DEVOIR AVERAGE END --}}

                {{-- SUBJECT COEF START --}}
                <td class="td-text"> {{ $subject->coef }}</td>
                {{-- SUBJECT COEF END --}}


                {{-- FINAL MARK START --}}
                @php
                    $finalMark =   $totalAVG * $subject->coef ;

                        $getfinal_marks = App\Models\student_final_mark::where( 'student_id', $marks['0']->student_id )
                        ->where( 'year_id',  $marks['0']->year_id )->where( 'season_id', $marks['0']->season_id )
                        ->where( 'assign_subject_id', $subject->id )->get();
                        
                        if ($getfinal_marks->toArray() == null) {
                            
                            $finalMrk = new App\Models\student_final_mark();
                            $finalMrk->student_id =  $marks['0']->student_id;
                            $finalMrk->id_no =  $marks['0']->id_no;
                            $finalMrk->year_id =   $marks['0']->year_id;
                            $finalMrk->class_id =  $marks['0']->class_id;
                            $finalMrk->group_id =  $marks['0']->group_id;
                            $finalMrk->branch_id =  $marks['0']->branch_id;
                            $finalMrk->assign_subject_id = $subject->id;
                            $finalMrk->season_id = $marks['0']->season_id;
                            $finalMrk->final_marks = $finalMark ;

                        $finalMrk->save();
                        }
                        
                         
                    
                @endphp
                <td class="td-text"> {{ $finalMark }}</td>
                {{-- FINAL MARK END --}}


                {{-- POSITION MARK START --}}
                @php
                    $getRank = DB::query()->fromSub(function ($query) {
                    $query->from( 'SELECT' 't.id', 't.final_marks', @rownum := @rownum + 1 AS 'position'
                    ,'FROM' 'student_final_marks' as' t' )
                    ->join('SELECT' @rownum := '0')r
                    ->orderBy('t.final_marks DESC');
                    }, 'x')->select( 'x.id', 'x.position',' x.final_marks');

                    
                @endphp
                {{-- POSITION MARK END --}}


            @endforeach

            {{-- <tr>
                <td> Anglais</td>
                <td  class="td-text"> 10</td>
                <td  class="td-text"> 15</td>
                <td  class="td-text"> </td>
                <td> </td>
                <td  class="td-text">11 </td>
                <td  class="td-text">09</td>
                <td  class="td-text">10</td>
                <td  class="td-text">4</td>
                <td  class="td-text">40</td>
                <td  class="td-text">24ex</td>
                <td>OURO-AGORO</td>
                <td class="observation_td">passable. peut mieut faire</td>
                <td></td>
            </tr>

            <tr class="border_style" >
                <td  ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td class="td-text" colspan="2">Total</td>
                <td class="td-text">4</td>
                <td class="td-text">40</td>
                <td class="td-text">Rang</td>
                <td class="td-text">Sur Eleves Classé</td>
                
            </tr> --}}
        </tbody>


    </table>

</body>

</html>
