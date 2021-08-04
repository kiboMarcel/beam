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
        $data['teachers'] = User::where('designation_id', 2)->get();
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

    public function  AssignSubjectEdit( $class_id, $branch_id){

        $data['editData'] =  AssignSubject::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('subject_id', 'asc')->get();
        //dd($data['editData']->toArray());
        $data['subjects']= SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);

    }

    public function AssignSubjectUpdate(Request $request, $class_id,$branch_id){

        if($request->subject_id == NULL){
            dd('Error');
        }else{
             
            $countSubject = count($request->subject_id);
            AssignSubject::where( [
                [ 'class_id' ,$class_id], 
                ['branch_id', $branch_id]
                ])->delete();
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
        }
        return redirect()-> route('assign.subject.view')->with('successUpdate', '');

   
    }


    public function  AssignSubjectDetail(Request $request, $class_id, $branch_id){

        $data['detailData'] =  AssignSubject::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('subject_id', 'asc')->get();

        
        

        return view('backend.setup.assign_subject.detail_assign_subject', $data);

    }

}
