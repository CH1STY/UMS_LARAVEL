<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use DB;

class AccountManageBalanceController extends Controller
{
    public function studentAccountBalance(Request $request)
    {
        $account=Account::where('username',$request->session()->get('username'))
                            ->first();
        return view('account.manageStudentAccountBalance',compact('account'));
    }

    public function teacherAccountBalance(Request $request)
    {
        $account=Account::where('username',$request->session()->get('username'))
                            ->first();
        return view('account.manageTeacherAccountBalance',compact('account'));
    }

    public function empolyeeAccountBalance(Request $request)
    {
        $account=Account::where('username',$request->session()->get('username'))
                            ->first();
        return view('account.manageEmpolyeeAccountBalance',compact('account'));
    }

    public function salary(Request $request)
    {
        $account=Account::where('username',$request->session()->get('username'))
        ->first();
        return view('account.teacherSalaryList',compact('account'));
    }
    public function insertSalary(Request $request)
    {
        $data = array();
        $data['student_id']=$request->student_id;
        $data['balance']=$request->balance;

        DB::table('students')->insert($data);
        return Redirect::to('/insertSalary');
    }
    public function allStudent()
    {
        $allStudent_info=DB::table('students')
        ->get();
        $manageStudent=view('manageStudentAccountBalance')
        ->with('all_student_info',$allStudent_info);
       
        return view('manageStudentAccountBalance')
        ->with('allContact'$manageStudent);
    }

}
