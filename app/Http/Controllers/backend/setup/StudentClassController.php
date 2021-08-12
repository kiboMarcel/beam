<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentClass;

class StudentClassController extends Controller
{
    //

    public function ViewStudentClass(){
        $data['allClass'] =  StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);

    }


    public function StudentClassAdd(){
        
        return view('backend.setup.student_class.add_class');

    }


    public function StudentClassStore(Request $request){
        
        $countClass = count($request->name);
        if($countClass != NULL){
            for($i=0; $i< $countClass; $i++) {
                $data =  new StudentClass();

               /*  $validateData = $request->validate([
                    'name' => 'required|unique:school_subjects,name',
                ]); */


                $data->name = $request->name[$i];

                $data->save();
            }
        }
      

        return redirect()-> route('student.class.view')->with('success', '');

    }


    public function  StudentClassEdit( $id){

        $editClass =  StudentClass::find($id);
        

        return view('backend.setup.student_class.edit_class', compact('editClass'));

    }

    public function StudentClassUpdate(Request $request, $id){

        $class =  StudentClass::find($id);
        
        $class -> name = $request->name;
        $class -> save();

        return redirect()-> route('student.class.view')->with('successUpdate', '');

    }


    public function  StudentClassDelete(Request $request, $id){

        $class =  StudentClass::find($id);
        
        $class -> delete();
        

        return redirect()-> route('student.class.view');

    }
}
