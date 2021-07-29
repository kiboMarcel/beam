<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignClasse;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentBranch;


class AssignClassController extends Controller
{
    public function ViewAssignClass(){
        $data['allData'] =  AssignClasse::select('class_id', 'branch_id')->groupBy('class_id', 'branch_id')->get();
        return view('backend.setup.assign_class.view_assign_class', $data);

    }

    public function AssignClassAdd(){
        
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        return view('backend.setup.assign_class.add_assign_class', $data);

    }

    public function AssignClassStore(Request $request){
        
        $countBranch = count($request->branch_id);
        if($countBranch != NULL){
            for($i=0; $i< $countBranch; $i++) {
                $assign_class = new AssignClasse();
                $assign_class-> class_id = $request->class_id;
                $assign_class->branch_id = $request->branch_id[$i];
                $assign_class->group_id = $request->group_id[$i];

                $assign_class->save();
            }
        }

        return redirect()-> route('assign.class.view');

    }

    public function  AssignClassEdit( $class_id, $branch_id){

        $data['editData'] =  AssignClasse::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('class_id', 'asc')->get();
        //dd($data['editData']->toArray());
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        return view('backend.setup.assign_class.edit_assign_class', $data);

    }

    public function AssignClassUpdate(Request $request, $class_id,$branch_id){

        if($request->branch_id == NULL){
            dd('Error');
        }else{
             
            $countClass = count($request->branch_id);
            AssignClasse::where( [
                [ 'class_id' ,$class_id], 
                ['branch_id', $branch_id]
                ])->delete();
            if($countClass != NULL){
                for($i=0; $i< $countClass; $i++) {
                    $assign_class = new AssignClasse();
                    $assign_class-> class_id = $request->class_id;
                    $assign_class->branch_id = $request->branch_id[$i];
                    $assign_class->group_id = $request->group_id[$i];
    
                    $assign_class->save();
                }
            }
        }
        return redirect()-> route('assign.class.view');

   
    }

    public function  AssignClassDetail(Request $request, $class_id, $branch_id){

        $data['detailData'] =  AssignClasse::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('class_id', 'asc')->get();

        
        

        return view('backend.setup.assign_class.detail_assign_class', $data);

    }
}
