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

use DB;
use PDF;


class MarkSheetController extends Controller
{
    public function MarkSheetView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        $data['exam_types'] = ExamType::all();
        $data['seasons'] = SchoolSeason::all();

        return view('backend.s_report.marksheet.view_marksheet', $data);
    }


    public function MarkSheetGet($year_id, $class_id, $branch_id, $group_id, $student_id){

        //dd($group_id);
        $data['year_id'] =  $year_id;
        $data['class_id'] =  $class_id;
        $data['branch_id'] =  $branch_id;
        $data['group_id'] =  $group_id;
        $data['student_id'] =  $student_id;
       
        //get subject
        $data['subjects'] = AssignSubject::with(['school_subject'])->where('class_id', $class_id)
        ->where('branch_id', $branch_id)->get();

        //get marks
        $data['marks'] = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group' ,'season'])
        ->where('student_id', $student_id)->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('group_id', $group_id)->where('branch_id', $branch_id)->get();

        //dd($data['marks']->toArray());





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
        
        //return view('backend.s_report.marksheet.student_marksheet', $data);
    }
}

