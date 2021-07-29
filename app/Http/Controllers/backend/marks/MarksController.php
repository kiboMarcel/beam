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
use App\Models\SchoolSeason;

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
            $data['seasons'] = SchoolSeason::all();

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
                $data->season_id = $request->season_id;
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
        /* $exam_type_id = $request->exam_type_id; */
        $assign_subject_id = $request->assign_subject_id;

        $getStudents = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('assign_subject_id' ,$assign_subject_id)
        ->where('group_id', $group_id)->where('branch_id', $branch_id)->groupBy('student_id')->get();


        //dd($getStudents);
        return response()->json($getStudents);

    }


    public function MarksStudentDetail($student_id, $assign_subject_id){
        
        //dd($exam_type_id);

        $data['detail'] = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('student_id', $student_id)->get();

      
        $data['devoirMarks'] = StudentMarks::select('student_marks.*')->with(['student','assign_subject', 'exam_type'])->
        where('student_id', $student_id)->where('assign_subject_id', $assign_subject_id)->
        where('exam_types.name', 'Devoir')->
        leftjoin('exam_types', 'student_marks.exam_type_id', '=', 'exam_types.id')->get();

        $data['examMarks'] = StudentMarks::select('student_marks.*')->with(['student','assign_subject', 'exam_type'])->
        where('student_id', $student_id)->where('assign_subject_id', $assign_subject_id)->
        where('exam_types.name', 'Composition')->
        leftjoin('exam_types', 'student_marks.exam_type_id', '=', 'exam_types.id')->get();

        //dd($data['examMarks']);
        return view('backend.marks.marks_detail', $data);

    }

    public function MarksStudentUpdate(Request $request,  $student_id, $assign_subject_id){

        
        if($request->d_marks == null || $request->e_marks == null ){
            dd('Error');
        }else{
            $count_d_marks = count($request->d_marks);
            $count_e_marks = count($request->e_marks);

           
            //DEVOIR MARK UPDATE
            if($count_d_marks != NULL){
               
                StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['exam_type_id', '1']
                    ])->delete();

                for($i=0; $i< $count_d_marks; $i++) {
                    $d_mark = new StudentMarks();
                    $d_mark-> student_id = $student_id;
                    $d_mark-> id_no = $request->id_no;
                    $d_mark-> year_id = $request->year_id;
                    $d_mark-> class_id = $request->class_id;
                    $d_mark-> branch_id = $request->branch_id;
                    $d_mark-> group_id = $request->group_id;
                    $d_mark->assign_subject_id = $assign_subject_id;
                    $d_mark->season_id = $request->season_id;
                    $d_mark->exam_type_id = '1';
                    $d_mark->marks = $request->d_marks[$i];
        
                    $d_mark->save();
                    }
                }
            
            //EXAM MARKS UPDATE
            if($count_e_marks != NULL){
               
                StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['exam_type_id', '2']
                    ])->delete();

                for($i=0; $i< $count_e_marks; $i++) {
                    $e_mark = new StudentMarks();
                    $e_mark-> student_id = $student_id;
                    $e_mark-> id_no = $request->id_no;
                    $e_mark-> year_id = $request->year_id;
                    $e_mark-> class_id = $request->class_id;
                    $e_mark-> branch_id = $request->branch_id;
                    $e_mark-> group_id = $request->group_id;
                    $e_mark->assign_subject_id = $assign_subject_id;
                    $e_mark->season_id = $request->season_id;
                    $e_mark->exam_type_id = '2';
                    $e_mark->marks = $request->e_marks[$i];
        
                    $e_mark->save();
                    }
                }
           
    
        }
        
            
             return redirect()->back();
        }

 
    /* public function MarksStudentUpdate(Request $request){

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
 } */

}
