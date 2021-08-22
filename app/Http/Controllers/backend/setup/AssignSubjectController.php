<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\SchoolSubject;
use App\Models\StudentBranch;
use App\Models\User;

class AssignSubjectController extends Controller
{
    //
    public function ViewAssignSubject(){
        //$data['allData'] =  AssignSubject::all();
        $data['allData'] =  AssignSubject::select('class_id', 'branch_id')->groupBy('class_id', 'branch_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);

    }

    public function AssignSubjectAdd(){
        
        $data['subjects']= SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        $data['teachers'] = User::where('designation_id', 1)->get();
        return view('backend.setup.assign_subject.add_assign_subject', $data);

    }

    public function AssignSubjectStore(Request $request){
        
        $countSubject = count($request->subject_id);
        if($countSubject != NULL){
            for($i=0; $i< $countSubject; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject-> class_id = $request->class_id;
                $assign_subject-> branch_id = $request->branch_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->teacher_id = $request->teacher_id[$i];
                $assign_subject->coef = $request->subjective_mark[$i];

                $assign_subject->save();
            }
        }

        return redirect()-> route('assign.subject.view')->with('success', '');

    }

    public function  AssignSubjectEdit( $class_id, $branch_id=null){

        $data['editData'] =  AssignSubject::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('subject_id', 'asc')->get();
        //dd($data['editData']->toArray());
        $data['subjects']= SchoolSubject::all();
        $data['teachers'] = User::where('designation_id', 1)->get();
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);

    }

    public function AssignSubjectUpdate(Request $request, $class_id, $jsonId, $branch_id=null){
        $idArray=json_decode($jsonId);

        if($request->subject_id == NULL){
            dd('Error');
        }else{
             
            $countSubject = count($request->subject_id);
            $subject_Record =  AssignSubject::where( [
                [ 'class_id' ,$class_id], 
                ['branch_id', $branch_id]
                ])->get();

            $countRecord = count($subject_Record);

            if($countSubject == $countRecord){
                for($i=0; $i< $countSubject; $i++) {
                    $assign_subject =  AssignSubject::find($idArray[$i]);
                    $assign_subject-> class_id = $request->class_id;
                    $assign_subject-> branch_id = $request->branch_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->teacher_id = $request->teacher_id[$i];
                    $assign_subject->coef = $request->subjective_mark[$i];
    
                    $assign_subject->save();
                }
            }else{
                for($i=0; $i< $countRecord; $i++) {
                    $assign_subject =  AssignSubject::find($idArray[$i]);
                    $assign_subject-> class_id = $request->class_id;
                    $assign_subject-> branch_id = $request->branch_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->teacher_id = $request->teacher_id[$i];
                    $assign_subject->coef = $request->subjective_mark[$i];
    
                    $assign_subject->save();
                }
                $last =$countSubject - $countRecord  ;
                
                for($i=0; $i< $last; $i++) {
                    $new_assign_subject = new AssignSubject();
                    $j = ($i + $last);
                    $new_assign_subject-> class_id = $request->class_id;
                    $new_assign_subject-> branch_id = $request->branch_id;
                    $new_assign_subject->subject_id = $request->subject_id[$j];
                    $new_assign_subject->full_mark = $request->full_mark[$j];
                    $new_assign_subject->teacher_id = $request->teacher_id[$j];
                    $new_assign_subject->coef = $request->subjective_mark[$j];
    
                    $new_assign_subject->save();
                }
            }
        }
        return redirect()-> route('assign.subject.view')->with('successUpdate', '');

   
    }


    public function  AssignSubjectDetail(Request $request, $class_id, $branch_id=null){

        $data['detailData'] =  AssignSubject::with('school_subject')->where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        get()->sortBy('school_subject.name' );

        
        

        return view('backend.setup.assign_subject.detail_assign_subject', $data);

    }


    public function AssignSubjectDelete(Request $request, $class_id,$branch_id){

        
            AssignSubject::where( [
                [ 'class_id' ,$class_id], 
                ['branch_id', $branch_id]
                ])->delete();
           
        return redirect()->route('assign.subject.view');

    }

    public function AssignSubjectDeleteSingle( $id){

       
        $schoolingfee = AssignSubject::find($id);

        $schoolingfee->delete();
        return redirect()->back();
    }

}
