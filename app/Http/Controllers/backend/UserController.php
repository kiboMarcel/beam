<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //

    public function UserView(){
        $data['allUsers'] = User::all();
        return view('backend.user.view_user', $data);
    }


    public function UserAdd(){
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request){

        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $data -> usertype = $request->usertype;
        $data -> name = $request->name;
        $data -> email = $request->email;
        $data -> password = bcrypt($request->password);
        $data -> save();

        

        return redirect()-> route('user.view');

    }

    public function UserEdit($id){
        
        $editData = User::find($id);

        return view('backend.user.edit_user', compact('editData'));
    }



    public function UserUpdate(Request $request, $id){

        $data =  User::find($id);
        $data -> usertype = $request->usertype;
        $data -> name = $request->name;
        $data -> email = $request->email;
        $data -> save();
        

        return redirect()-> route('user.view');

    }


    public function UserDelete(Request $request, $id){

        $user =  User::find($id);
        
        $user -> delete();
        

        return redirect()-> route('user.view');

    }
}
