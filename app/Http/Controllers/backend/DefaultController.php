<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\StudentMarks;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;

class DefaultController extends Controller
{
    public function MarksGetSubjects(Request $request){

        $class_id = $request->class_id;
        $branch_id = $request->branch_id;

        $allData = AssignSubject::with(['school_subject'])->where('class_id', $class_id)
        ->where('branch_id', $branch_id)->get();
       
        return response()->json($allData);
    }


    public function GetSutudents(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;

        $allData = AssignStudent::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('branch_id', $branch_id)->get();
       
        return response()->json($allData);
    }
}
