<?php

namespace App\Http\Controllers\backend\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentMarks;

use App\Models\User;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\AssignClasse;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;
use App\Models\SchoolSeason;
use App\Models\Student_final_mark;
use App\Models\StudentFinalAVG;

use DB;
use PDF;


class MarkSheetController extends Controller
{
    public function MarkSheetView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = AssignClasse::groupBy('class_id')->get();
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        $data['exam_types'] = ExamType::all();
        $data['seasons'] = SchoolSeason::all();

        return view('backend.s_report.marksheet.view_marksheet', $data);
    }


    public function MarkSheetGet($year_id, $class_id, $branch_id, $group_id, $student_id, $season_id){

        //dd($group_id);
        $data['year_id'] =  $year_id;
        $data['class_id'] =  $class_id;
        $data['branch_id'] =  $branch_id;
        $data['group_id'] =  $group_id;
        $data['student_id'] =  $student_id;
        $data['season_id'] =  $season_id;
       
        //count student
        $data['totalStudent'] = AssignStudent::where('class_id', $class_id)
        ->where('branch_id', $branch_id)->where('year_id', $year_id)->count();

        //get subject
        $data['subjects'] = AssignSubject::with(['school_subject'])->where('class_id', $class_id)
        ->where('branch_id', $branch_id)->get();

        //get coef sum
        $data['coefSum'] = AssignSubject::where('class_id', $class_id)
        ->where('branch_id', $branch_id)->sum('coef');

        //get marks
        $data['marks'] = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group' ,'season'])
        ->where('student_id', $student_id)->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('group_id', $group_id)->where('branch_id', $branch_id)->get();

        //total season avg --Moyenne Totale des matiere du trimestre ou semestre
        $data['seasonAvg'] = StudentMarks::where('student_id', $student_id)->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('season_id', $season_id)->sum('marks');

        //final mark avg -- Moyenne final du trimestre
        $data['marks_avg'] = StudentFinalAVG::where('student_id', $student_id)
        ->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('season_id', $season_id)->first();

        //max avg of the class -- Moyenne Max du trimestre de la classe
        $data['marks_avg_max'] = StudentFinalAVG::where('year_id', $year_id)
        ->where('class_id', $class_id)->where('branch_id', $branch_id)
        ->where('group_id', $group_id)->where('season_id', $season_id)->max('final_avg');

        //min avg of the class -- Moyenne Min du trimestre de la classe
        $data['marks_avg_min'] = StudentFinalAVG::where('year_id', $year_id)
        ->where('class_id', $class_id)->where('branch_id', $branch_id)
        ->where('group_id', $group_id)->where('season_id', $season_id)->min('final_avg');

        $data['class_avg'] = ($data['marks_avg_min'] + $data['marks_avg_min']) / 2 ; 

        if($data['marks_avg'] == null ){
            return view('backend.s_report.marksheet.avg_error', $data);
        } else{
            $pdf = PDF::loadView('backend.s_report.marksheet.student_marksheet', 
            $data, 
            [], 
            [ 
              'title' => 'Certificate', 
              'format' => 'A4-L',
              'orientation' => 'L'
            ]);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }   
        

        //dd($data['marks']->toArray());





       
        
        //return view('backend.s_report.marksheet.student_marksheet', $data);
    }
}

