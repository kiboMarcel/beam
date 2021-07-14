<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\FeeCategoryAmount;
use App\Models\AssignStudent;
use App\Models\Schooling;
use App\Models\Slice;
use App\Models\User;
use DB;
use PDF;

class SchoolingController extends Controller
{
    //
    public function ViewSchooling(){


        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['years'] =  StudentYear::all();

        return view('backend.student.schooling_fee.view_schooling_fee', $data);
    }
    

    public function SchoolingData(Request $request){
       /*  $year_id = $request->year_id;
        $class_id = $request->class_id; */
        //dd($request->searchText);
        /* if ($search !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        } */
        
        $student =  AssignStudent::select('assign_students.*')->with(['student'])->
        where('users.usertype', 'Student')->
        where('users.name',  'like', '%' . $request->searchText . '%' )->
        leftjoin('users', 'assign_students.student_id', '=', 'users.id')->get();
         //dd($student);
        $html['thsource']  = '<th>#</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th> Nom</th>';
        $html['thsource'] .= '<th>Classe</th>';
        $html['thsource'] .= '<th>Ecollage </th>';
        $html['thsource'] .= '<th>Deja payer </th>';
        /* $html['thsource'] .= '<th>Discount </th>'; */
        $html['thsource'] .= '<th>Reste a payer </th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($student as $key => $v) {
            $schoolingfee = FeeCategoryAmount::where('fee_category_id','6')
            ->where('class_id',$v->class_id)->first();

            $schooling = Schooling::where('student_id',$v->student_id)->first();
             //dd($schooling->payed);
            $color = 'success';
            $color2nd = 'info';

            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student_class']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.doubleval($schoolingfee->amount).' Fcfa'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.doubleval($schooling->payed).' Fcfa'.'</td>';
            /* $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>'; */
            
           /*  $originalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee-(float)$discounttablefee; */

            $mustpayed = $schoolingfee->amount -  $schooling->payed;
            
            $html[$key]['tdsource'] .='<td>'.$mustpayed.' Fcfa'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            if( $schooling->payed == $schoolingfee->amount){
                $html[$key]['tdsource'] .='<a class="btn btn-sm disabled btn-'.$color.'" 
                title="Pay" target="_blanks" >En regle</a>';
            }else{
                $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color2nd.'" 
            title="Pay" target="_blanks" href="'.route("student.schooling.pay",$v->student_id).'?student_id='.$v->student_id.'">Payer</a>';
            }
            
            $html[$key]['tdsource'] .= '</td>';

        }  
       return response()->json(@$html);
    }

    public function SchoolingPaymentView(Request $request, $student_id){


        $data['student'] =  AssignStudent::with(['student'])->where('student_id', $student_id)->first();
        //dd($student);
        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['years'] =  StudentYear::all();

        return view('backend.student.schooling_fee.pay_schooling', $data);
    }


    public function SchoolingStore(Request $request, $student_id ){


        $student =  AssignStudent::with(['student'])->where('student_id', $student_id)->first();
        $student_id = $student->student_id;
        $class_id = $student->class_id;
        $branch_id = $student->branch_id;
        
        /* $group_id = $student->group_id; */

        $validateData = $request->validate([
            'schooling_fee' => 'required',
        ]);
        
        $get_paid_fee = Schooling::where('student_id', $student_id)->first();

        $new_fee = $get_paid_fee->payed + $request->schooling_fee;

        //dd($get_paid_fee->payed);
        
        $data =  Schooling::where('student_id', $student_id)->first();

        $data->payed = $new_fee;
       
        /* $data->payed = $request->group_id; */
       

        $data->save();


        return redirect()-> route('schooling.fee.view');

    }
}
