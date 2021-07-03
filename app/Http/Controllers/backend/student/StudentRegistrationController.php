<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use DB;

class StudentRegistrationController extends Controller
{
    //
    public function ViewRegistration(){
        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        $data['year_id'] =  StudentYear::orderBy('id', 'asc')->first()->id;
        $data['class_id'] =  StudentClass::orderBy('id', 'desc')->first()->id;
        //dd($data['year_id']);
        $data['allData'] =  AssignStudent::where('year_id',$data['year_id'])->
        where('class_id', $data['class_id'])->get();
        return view('backend.student.student_reg.view_stud_reg', $data);

    }

    public function StudentSearch(Request $request){
        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        $data['year_id'] =  $request->year_id;
        $data['class_id'] =   $request->class_id;
        $data['branch_id'] =   $request->branch_id;

        $data['allData'] =  AssignStudent::where('year_id', $request->year_id)->
        where('class_id', $request->class_id)->where('branch_id', $request->branch_id)->get();
        //dd($data['allData']);
        return view('backend.student.student_reg.view_stud_reg', $data);

    }


    public function RegistrationAdd(){
        $data['classes'] =  StudentClass::all();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();
        return view('backend.student.student_reg.add_stud_reg', $data);

    }



    public function RegistrationStore(Request $request){
        
        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first();

            if($student == null){
                $firstReg = 0;
                $studentId = $firstReg+1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId < 100){
                    $id_no = '00'.$studentId;
                }elseif($studentId < 1000){
                    $id_no = '0'.$studentId;
                }
            }else{
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student+1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId < 100){
                    $id_no = '00'.$studentId;
                }elseif($studentId < 1000){
                    $id_no = '0'.$studentId;
                }
            }

            $final_id_no = $checkYear.$id_no;
            $user= new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->nationality = $request->nationality;
            $user->date_of_birth = date('Y-m-d', strtotime( $request->date_of_birth) );


            $user->save();


            $assign_student= new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->class_id = $request->class_id;
            $assign_student->branch_id = $request->branch_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->year_id = $request->year_id;

            $assign_student->save();

           /*  $discount_student= new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;

            $discount_student->save(); */
        });

        return redirect()-> route('student.registration.view');

    }


    public function  RegistrationEdit( $student_id){

        $data['classes'] =  StudentClass::all();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();


        $data['editData'] =  AssignStudent::with(['student'])->where('student_id', $student_id)->first();
        
       // dd($data['editData']->toArray());

        return view('backend.student.student_reg.edit_stud_reg', $data);

    }

    public function RegistrationUpdate(Request $request, $student_id){

        DB::transaction(function () use ($request, $student_id) {
           

            $user=  User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->nationality = $request->nationality;
            $user->date_of_birth = date('Y-m-d', strtotime( $request->date_of_birth) );


            $user->save();


            $assign_student=  AssignStudent::where('id', $request->id)->
            where('student_id', $student_id)->first();
            
            $assign_student->class_id = $request->class_id;
            $assign_student->branch_id = $request->branch_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->year_id = $request->year_id;

            $assign_student->save();

          /*   $discount_student= new DiscountStudent::where('assign_student_id', $request->id)->
            first();

            $discount_student->discount = $request->discount;

            $discount_student->save(); */
        });

        return redirect()-> route('student.registration.view');
    }


    public function  StudentPromotionView(Request $request, $student_id){


        $data['classes'] =  StudentClass::all();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        $data['editData'] =  AssignStudent::with(['student'])->where('student_id', $student_id)->first();

        return view('backend.student.student_reg.promotion_stud_reg', $data);
    }


    public function StudentPromotion(Request $request, $student_id){

        DB::transaction(function () use ($request, $student_id) {
           

            $user=  User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->gender = $request->gender;
          


            $user->save();


            $assign_student = new AssignStudent();
            
            $assign_student->student_id = $request->student_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->branch_id = $request->branch_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->year_id = $request->year_id;

            $assign_student->save();

          /*   $discount_student=  DiscountStudent();

            $discount_student->discount = $request->discount;
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->save(); */
        });

        return redirect()-> route('student.registration.view');
    }
}
