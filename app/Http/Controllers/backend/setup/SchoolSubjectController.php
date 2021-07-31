<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    //
    public function ViewSubjectType(){
        $data['allData'] =  SchoolSubject::all();
        return view('backend.setup.school_subject.view_subject_type', $data);

    }


    public function SubjectTypeAdd(){
        
        return view('backend.setup.school_subject.add_subject_type');

    }


    public function SubjectTypeStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);
        
        $data =  new SchoolSubject();

        $data->name = $request->name;
        $data->save();

        //$flash = 'ok';

        return redirect()-> route('subject.type.view')->with('success', '');

    }


    public function  SubjectTypeEdit( $id){

        $editSubject =  SchoolSubject::find($id);
        

        return view('backend.setup.school_subject.edit_subject_type', compact('editSubject'));

    }

    public function SubjectTypeUpdate(Request $request, $id){

        $subjectType =  SchoolSubject::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name'.$subjectType->$id,
        ]);
        
        $subjectType -> name = $request->name;
        $subjectType -> save();

        return redirect()-> route('subject.type.view')->with('successUpdate', '');

    }


    public function  SubjectTypeDelete(Request $request, $id){

        $subjectType =  SchoolSubject::find($id);
        
        $subjectType -> delete();
        

        return redirect()-> route('subject.type.view');

    }
}
