<?php

namespace App\Http\Controllers\backend\marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentMarks;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;

use DB;
use PDF;

class MarksController extends Controller
{
   
    public function MarksAdd(){

            $data['years'] = StudentYear::all();
            $data['classes'] = StudentClass::all();
            $data['branchs'] =  StudentBranch::all();
            $data['groups'] =  StudentGroup::all();
            $data['exam_types'] = ExamType::all();

            return view('backend.marks.marks_add', $data);
    }

    public function MarksStore(Request $request){

           $studenCount = $request->student_id;

           if($studenCount){
               for ($i=0 ; $i<count($request->student_id) ; $i++){

                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->branch_id = $request->branch_id;
                $data->group_id = $request->group_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];

                $data->save();

               }
           }

            return redirect()->back();
    }
   


    public function MarksEdit(Request $request){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.marks.marks_edit', $data);
    }

    public function MarksStudentEdit(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;
        $exam_type_id = $request->exam_type_id;
        $assign_subject_id = $request->assign_subject_id;

        $getStudents = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('assign_subject_id' ,$assign_subject_id)
        ->where('exam_type_id', $exam_type_id)->where('group_id', $group_id)->where('branch_id', $branch_id)->get();


        //dd($getStudents);
        return response()->json($getStudents);

    }

    public function MarksStudentUpdate(Request $request){

        StudentMarks::where('year_id', $request->year_id)->where('class_id', $request->class_id)
        ->where('branch_id', $request->branch_id)->where('group_id', $request->group_id)
        ->where('exam_type_id', $request->exam_type_id)
        ->where('assign_subject_id', $request->assign_subject_id)->delete();

        $studenCount = $request->student_id;

        if($studenCount){
            for ($i=0 ; $i<count($request->student_id) ; $i++){

             $data = new StudentMarks();
             $data->year_id = $request->year_id;
             $data->class_id = $request->class_id;
             $data->branch_id = $request->branch_id;
             $data->group_id = $request->group_id;
             $data->assign_subject_id = $request->assign_subject_id;
             $data->exam_type_id = $request->exam_type_id;
             $data->student_id = $request->student_id[$i];
             $data->id_no = $request->id_no[$i];
             $data->marks = $request->marks[$i];

             $data->save();

            }
        }

         return redirect()->back();
 }

}
