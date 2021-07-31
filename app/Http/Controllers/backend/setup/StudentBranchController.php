<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentBranch;

class StudentBranchController extends Controller
{
    //

        
    public function ViewStudentBranch(){
        $data['allData'] =  StudentBranch::all();
        return view('backend.setup.student_branch.view_branch', $data);

    }


    public function StudentBranchAdd(){
        
        return view('backend.setup.student_branch.add_branch');

    }


    public function StudentBranchStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:student_branches,name',
        ]);
        
        $data =  new StudentBranch();

        $data->name = $request->name;
        $data->save();


        return redirect()-> route('student.branch.view')->with('success', '');

    }


    public function  StudentBranchEdit( $id){

        $editBranch =  StudentBranch::find($id);
        

        return view('backend.setup.student_branch.edit_branch', compact('editBranch'));

    }

    public function StudentBranchUpdate(Request $request, $id){

        $year =  StudentBranch::find($id);
        
        $year -> name = $request->name;
        $year -> save();

        return redirect()-> route('student.branch.view')->with('successUpdate', '');

    }


    public function  StudentBranchDelete(Request $request, $id){

        $class =  StudentBranch::find($id);
        
        $class -> delete();
        

        return redirect()-> route('student.branch.view');

    }
}


