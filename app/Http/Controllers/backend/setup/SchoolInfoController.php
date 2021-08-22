<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\schoolInfo;

class SchoolInfoController extends Controller
{
    //
         
    public function ViewInfo(){
        $data['allData'] =  schoolInfo::where('id', 1)->first();
      
        if($data['allData'] == null){
            return view('backend.setup.school_info.add_school_info');
        }else {
            return view('backend.setup.school_info.view_school_info', $data);
        }
       

    }


    public function InfoAdd(){
        
        return view('backend.setup.school_info.add_school_info');

    }


    public function InfoStore(Request $request){
        
       
                $data =  new schoolInfo();

                
                $data->name = $request->name;
                $data->address = $request->address;
                $data->distric = $request->distric;
                $data->num = $request->num;

                if ($request->file('image')) {
                    $file = $request->file('image');
                    @unlink(public_path('upload/school_image/'.$data->image));
                    $filename = date('YmdHi').$file->getClientOriginalName();
                    $file->move(public_path('upload/school_image'),$filename );
                    $data['image'] = $filename;
                }
                
                $data -> save();

                return redirect()-> route('school.info.view')->with('success', '');
        }
        


    public function  InfoEdit( $id){

        $edit =  schoolInfo::find($id);
        

        return view('backend.setup.school_info.edit_school_info', compact('edit'));

    }

    public function InfoUpdate(Request $request, $id){

        $data =  schoolInfo::find($id);
       
        $data->name = $request->name;
        $data->address = $request->address;
        $data->distric = $request->distric;
        $data->num = $request->num;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/school_image/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/school_image'),$filename );
            $data['image'] = $filename;
        }

        $data -> save();

        return redirect()-> route('school.info.view')->with('successUpdate', '');

    }


    public function  StudentGroupDelete(Request $request, $id){

        $class =  schoolInfo::find($id);
        
        $class -> delete();
        

        return redirect()-> route('school.info.view');

    }
}
