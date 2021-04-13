<?php

namespace App\Http\Controllers;

use App\Account;
use App\Course;
use App\Student;
use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherCourse;
use DB;
use PDF;

class TeacherAccountController extends Controller
{
    public function viewAccount(Request $request)
    {
        $teacher = Teacher::where('username', $request->session()->get('username'))
            ->first();


        return view('teacher.viewAccount', compact('teacher'));
    }

    public function accountPrint(Request $request,$id)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert($id));
        return $pdf->download($id.'account.pdf');
    }

    function convert($id)
    {
        $teacher = Teacher::where('teacher_id', $id)->first();
        //$account = Account::where('username', $teacher->username)->first();

        $output = '<h2><b>'.$teacher->username.'</b></h2>
                    <table>
                        <tr>
                            <th> NAME</th>
                            <th>'.$teacher->name.'</th>
                        </tr>
                        <tr>
                            <th>USERNAME</th>
                            <th>'.$teacher->username.'</th>
                        </tr>
                        <tr>
                            <th>ACCOUNT ID</th>
                            <th>'.$teacher->account_id.'</th>
                        </tr>
                        <tr>
                            <th>EMAIL</th>
                            <th>'.$teacher->email.'</th>
                        </tr>
                        <tr>
                            <th>PHONE</th>
                            <th>'.$teacher->phone.'</th>
                        </tr>
                        <tr>
                            <th>SALARY</th>
                            <th>'.$teacher->salary.'</th>
                        </tr>
                        <tr>
                            <th> STATUS</th>
                            <th>'.$teacher->status.'</th>
                        </tr>
                        <tr>
                            <th>BIRTHDATE</th>
                            <th>'.$teacher->birthdate.'</th>
                        </tr>
                </table>';
        return $output;
    }
}
