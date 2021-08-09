<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccountEmployeeSalary;

use App\Models\User;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;

use App\Models\EmployeeAttendance;

use PDF;

class MonthlySalaryController extends Controller
{
    //
    public function MonthlySalaryView(){
        return view('backend.employee.monthly_salary.view_monthly_salary');

    }

    

    public function MonthlySalaryGet(Request $request){
       

        $date = date('Y-m', strtotime($request->date));

        if($date != ''){
            $where[] =  ['date', 'like', $date.'%'];
        }
       
        $data =  EmployeeAttendance::select('employee_id')->groupBy('employee_id') 
        ->with(['user'])->where($where)->get();
        //dd($data);

        if($data->toArray() == null || $date== '' ){

            $html['h5source']  = '<h5>Pas de correspondance</h5>';
            return response()->json(@$html); 
        }
        else{
            //dd($student->toArray());
            $html['thsource']  = '<th>#</th>';
            $html['thsource'] .= '<th>ID No</th>';
            $html['thsource'] .= '<th> Nom Employé</th>';
            $html['thsource'] .= '<th>Salaire de Base</th>';
            $html['thsource'] .= '<th>Salaire de ce mois </th>';
            $html['thsource'] .= '<th>Actions </th>';


            foreach ($data as $key => $attend) {
                $totalattend = EmployeeAttendance::with(['user'])->where($where)
                ->where('employee_id',$attend->employee_id)->get();

                $absentcount = count($totalattend->where('attend_status', 'absent'));
                
                $color = 'success';
                $color2nd = 'info';

            

                $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';

                $salary = (float)$attend['user']['salary'];
                $salaryPerDay = $salary/30;
                $totalSalaryMinus = (float)$absentcount * (float)$salaryPerDay;
                $totalSalary = (float)$salary - (float)$totalSalaryMinus;
                $round = round($totalSalary, 2) ;

                $html[$key]['tdsource'] .= '<td>'.$round.' Fcfa'.'</td>';

                $html[$key]['tdsource'] .='<td>'.'<a class="btn btn-sm btn-'.$color2nd.'" 
                title="Pay" target="_blanks" href="'.route("employee.monthly.salary.pay",$attend->employee_id, ).'">Payer</a>'.'</td>';
                
            

            } 
            return response()->json(@$html); 

        }
    }

    public function MonthlySalaryPay(Request $request, $employee_id){
        
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m', strtotime($id->date));

        if($date != ''){
            $where[] =  ['date', 'like', $date.'%'];
        }



        $data['details'] =  EmployeeAttendance::with(['user'])->
        where($where)->where('employee_id', $id->employee_id)->get();


        $pdf = PDF::loadView('backend.employee.monthly_salary.monthly_salary_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


    }

}