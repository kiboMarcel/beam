<?php

namespace App\Http\Controllers\backend\marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AssignClasse;
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
use App\Models\AssignSubject;
use App\Models\Student_final_mark;
use App\Models\StudentFinalAVG;

use DB;
use PDF;

class MarksController extends Controller
{
   
    public function MarksAdd(){

            $data['years'] = StudentYear::all();
            $data['classes'] = AssignClasse::groupBy('class_id')->get();
            $data['branchs'] =  StudentBranch::all();
            $data['groups'] =  StudentGroup::all();
            $data['exam_types'] = ExamType::all();
            $data['seasons'] = SchoolSeason::all();

            return view('backend.marks.marks_add', $data);
    }

    public function MarksStore(Request $request){

        $studenCount = $request->student_id;

        if($request->exam_type_id == 1){
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
                    
                    $findDefaultMArk =  StudentMarks::where('year_id', $request->year_id)
                    ->where('student_id', $request->student_id[$i])
                    ->where('assign_subject_id', $request->assign_subject_id)
                    ->where('exam_type_id', '2')
                    ->where('season_id', $request->season_id)->get();
                
                   

                        if ($findDefaultMArk->toArray() == null) {
                            $defaultMark = new StudentMarks();
                            $defaultMark->year_id = $request->year_id;
                            $defaultMark->class_id = $request->class_id;
                            $defaultMark->branch_id = $request->branch_id;
                            $defaultMark->group_id = $request->group_id;
                            $defaultMark->season_id = $request->season_id;
                            $defaultMark->assign_subject_id = $request->assign_subject_id;
                            $defaultMark->exam_type_id = '2';
                            $defaultMark->student_id = $request->student_id[$i];
                            $defaultMark->id_no = $request->id_no[$i];
                            $defaultMark->marks = '0';
    
                            $defaultMark->save();
                        }else{
                     
                        }

                }
            }
        }else{
            for ($i=0 ; $i<count($request->student_id) ; $i++){
 
                $findDefaultMArk =  StudentMarks::where('year_id', $request->year_id)
                ->where('student_id', $request->student_id[$i])
                ->where('assign_subject_id', $request->assign_subject_id)
                ->where('exam_type_id', $request->exam_type_id)
                ->where('season_id', $request->season_id)->first();
                
                //dd($findDefaultMArk);

                $findDefaultMArk->marks = $request->marks[$i];
    
                $findDefaultMArk->save();

               }
          
           }

           /// MARKS AVERAGE START

        for ($j=0 ; $j<count($request->student_id) ; $j++){
 
            //get subject
            $subjects = AssignSubject::with(['school_subject'])
                ->where('id', $request->assign_subject_id )->first();


            /*  $marksBysubjectDevoir = StudentMarks::where('assign_subject_id', $request->assign_subject_id)
            ->where('exam_type_id', '1')->where('student_id', $request->student_id[$j])
            ->where('year_id', $request->year_id)
            ->get();
            */
        
            $marksByDevoirAVG = StudentMarks::where('assign_subject_id', $request->assign_subject_id)
            ->where('exam_type_id', '1')->where('student_id', $request->student_id[$j])
            ->where('year_id', $request->year_id)->avg('marks');
        
            $marksBysubjectExam = StudentMarks::where('assign_subject_id', $request->assign_subject_id)
            ->where('exam_type_id', '2')->where('student_id', $request->student_id[$j])
            ->where('year_id', $request->year_id)->first();
            
            //dd($marksByDevoirAVG);
            $examMArk = $marksBysubjectExam->marks;
            $totalAVG =( $examMArk + $marksByDevoirAVG)/2;
                
            $finalMark =   $totalAVG * $subjects->coef ;
           
            $getfinal_marks = Student_final_mark::where( 'student_id', $request->student_id[$j] )
            ->where( 'year_id', $request->year_id )->where( 'season_id', $request->season_id )
            ->where( 'assign_subject_id',$request->assign_subject_id )->get();
            
            if ($getfinal_marks->toArray() == null) {
                
                $finalMrk = new Student_final_mark();
                $finalMrk->student_id =  $request->student_id[$j];
                $finalMrk->id_no =  $request->id_no[$j];
                $finalMrk->year_id =   $request->year_id;
                $finalMrk->class_id =  $request->class_id;
                $finalMrk->group_id =  $request->group_id;
                $finalMrk->branch_id =  $request->branch_id;
                $finalMrk->assign_subject_id =  $request->assign_subject_id;
                $finalMrk->season_id = $request->season_id;
                $finalMrk->final_marks = round($finalMark, 2) ;

                $finalMrk->save();


            }else{
                //find the existing mark to update
                $finalMrk =  Student_final_mark::where( 'student_id', $request->student_id[$j] )
                ->where( 'year_id', $request->year_id )->where( 'season_id', $request->season_id )
                ->where( 'assign_subject_id',$request->assign_subject_id )->first();
                
                $finalMrk->final_marks =  round($finalMark, 2) ;
                
                 $finalMrk->save();
                
                 //UPPDATE FINAL AVG TABLE 
                 //find the sum of all the final mark for the student
                 $sum_final_mark = Student_final_mark::where('student_id', $request->student_id[$j])
                 ->where('year_id', $request->year_id)->where('season_id', $request->season_id)
                 ->sum('final_marks');
 
                 //find the sum of the coef of the current class
                 $coef_sum = AssignSubject::where('class_id', $request->class_id)
                 ->where('branch_id', $request->branch_id)->sum('coef');
         
                  $fmarkAVG = ($sum_final_mark / $coef_sum) ;


                  //check if student final average exist 
                  $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id[$j])
                  ->where('year_id', $request->year_id)->where('season_id', $request->season_id)->get();

                  if($Avgcheck->toArray() == null){
                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $request->year_id;
                    $avg->season_id  = $request->season_id;
                    $avg->class_id  = $request->class_id;
                    $avg->branch_id  = $request->branch_id;
                    $avg->group_id  = $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $request->student_id[$j];
  
                    $avg->save();
                  }else{
                    $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id[$j])
                  ->where('year_id', $request->year_id)
                  ->where('season_id', $request->season_id)->delete();

                  $avg = new StudentFinalAVG();

                  $avg->year_id  = $request->year_id;
                  $avg->season_id  = $request->season_id;
                  $avg->branch_id  = $request->branch_id;
                  $avg->group_id  = $request->group_id;
                  $avg->class_id  = $request->class_id;
                  $avg->final_avg  = round($fmarkAVG, 2);
                  $avg->student_id  = $request->student_id[$j];

                  $avg->save();
                  }
                
                //UPPDATE FINAL AVG TABLE 

            }

            
       

        }
         
           /// MARKS AVERAGE END

            return redirect()->back();
    }
   


    public function MarksEdit(Request $request){

        $data['years'] = StudentYear::all();
        $data['classes'] = AssignClasse::groupBy('class_id')->get();
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

        $getStudents =  StudentMarks::select('student_marks.*')
        ->with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('assign_subject_id' ,$assign_subject_id)->where('branch_id', $branch_id)
        ->leftjoin('users', 'student_marks.student_id', '=', 'users.id')->orderBy('users.name')
        ->groupBy('student_id')->get();

        /* $getStudents = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('assign_subject_id' ,$assign_subject_id)
        ->where('group_id', $group_id)->where('branch_id', $branch_id)->groupBy('student_id')->get() */


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

    public function MarksStudentUpdate(Request $request,  $student_id, $assign_subject_id,  $year_id,$season_id ){

        
        if($request->d_marks == null  ){
            return redirect()->back()->with('error', '');
        }else{
            $count_d_marks = count($request->d_marks);
            $count_e_marks = count($request->e_marks);

           
            //DEVOIR MARK UPDATE
            if($count_d_marks != NULL){
               
                $updateMark = StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['season_id', $season_id],
                    ['year_id', $year_id],
                    ['exam_type_id', '1']
                    ])->delete();


                   // dd($updateMark); 

                    for($i=0; $i< $count_d_marks; $i++) {
                 
                    $e_mark = new StudentMarks();
                    $e_mark-> student_id = $student_id;
                    $e_mark-> id_no = $request->id_no;
                    $e_mark-> year_id = $request->year_id;
                    $e_mark-> class_id = $request->class_id;
                    $e_mark-> branch_id = $request->branch_id;
                    $e_mark-> group_id = $request->group_id;
                    $e_mark->assign_subject_id = $assign_subject_id;
                    $e_mark->season_id = $request->season_id;
                    $e_mark->exam_type_id = '1'; 
                    $e_mark->marks = $request->d_marks[$i];

                    $e_mark->save();
                    }
                }
            
            //EXAM MARKS UPDATE
            if($count_e_marks != NULL){
               
                $updateExamMark = StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['season_id', $season_id],
                    ['year_id', $year_id],
                    ['exam_type_id', '2']
                    ])->get();

                    

                for($i=0; $i< $count_e_marks; $i++) {
                   /*  $e_mark = new StudentMarks();
                    $e_mark-> student_id = $student_id;
                    $e_mark-> id_no = $request->id_no;
                    $e_mark-> year_id = $request->year_id;
                    $e_mark-> class_id = $request->class_id;
                    $e_mark-> branch_id = $request->branch_id;
                    $e_mark-> group_id = $request->group_id;
                    $e_mark->assign_subject_id = $assign_subject_id;
                    $e_mark->season_id = $request->season_id;
                    $e_mark->exam_type_id = '2'; */
                    $updateExamMark[$i]->marks = $request->e_marks[$i];
        
                    $updateExamMark[$i]->save();
                    }
                }
           
    
        }

        /// MARKS AVERAGE START
        $updateFinalMark = Student_final_mark::where( [
            [ 'student_id' ,$student_id], 
            [ 'assign_subject_id' ,$assign_subject_id], 
            ['season_id', $season_id],
            ['year_id', $year_id],
            ])->get();

            $subjects = AssignSubject::with(['school_subject'])
            ->where('id', $assign_subject_id )->first();

            $marksByDevoirAVG = StudentMarks::where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', '1')->where('student_id', $student_id)
            ->where('year_id', $year_id)->avg('marks');
    
            $marksBysubjectExam = StudentMarks::where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', '2')->where('student_id', $student_id)
            ->where('year_id', $year_id)->first();

            $examMArk = $marksBysubjectExam->marks;
            $totalAVG =( $examMArk + $marksByDevoirAVG)/2;
            
            $finalMark =   $totalAVG * $subjects->coef ;

            $finalMrk =  Student_final_mark::where( 'student_id', $student_id )
            ->where( 'year_id', $year_id )->where( 'season_id', $season_id )
            ->where( 'assign_subject_id',$assign_subject_id )->first();

            
            $finalMrk->final_marks = round($finalMark, 2)  ;

            $finalMrk->save();
            //dd($updateFinalMark);

            /// MARKS AVERAGE END


             //UPPDATE FINAL AVG TABLE 
                 //find the sum of all the final mark for the student
                 $sum_final_mark = Student_final_mark::where('student_id', $student_id)
                 ->where('year_id', $year_id)->where('season_id', $season_id)
                 ->sum('final_marks');
 
                 //find the sum of the coef of the current class
                 $coef_sum = AssignSubject::where('class_id', $request->class_id)
                 ->where('branch_id',  $request->branch_id)->sum('coef');
         
                  $fmarkAVG = ($sum_final_mark / $coef_sum) ;
                

                  //check if student final average exist 
                  $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id)
                  ->where('year_id', $request->year_id)->where('season_id', $request->season_id)->get();

                  if($Avgcheck->toArray() == null){
                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $year_id;
                    $avg->season_id  = $season_id;
                    $avg->class_id  =  $request->class_id;
                    $avg->branch_id  =  $request->branch_id;
                    $avg->group_id  =  $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $student_id;
  
                    $avg->save();
                  }else{
                    $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id)
                    ->where('year_id', $request->year_id)
                    ->where('season_id', $request->season_id)->delete();
  

                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $year_id;
                    $avg->season_id  = $season_id;
                    $avg->class_id  =  $request->class_id;
                    $avg->branch_id  =  $request->branch_id;
                    $avg->group_id  =  $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $student_id;
  
                    $avg->save();
                  }

                
                //UPPDATE FINAL AVG TABLE
            
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
