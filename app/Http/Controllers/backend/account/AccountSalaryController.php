<?php

namespace App\Http\Controllers\backend\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AccountEmployeeSalary;

use App\Models\User;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;

use App\Models\EmployeeAttendance;

use DB;
use PDF;


class AccountSalaryController extends Controller
{
    //

    public function ViewSalary(){
        $data['allData'] = AccountEmployeeSalary::all();

        return view('backend.account.emp_salary.view_employee_salary', $data); 
    }


    public function SalaryAdd(){
      

        return view('backend.account.emp_salary.add_employee_salary', $data); 
    }
}
