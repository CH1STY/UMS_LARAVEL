<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\University;
use App\Student;
use App\Teacher;
use App\Account;
use App\Subject;
use PDF;

class AdminReportGen extends Controller
{
    public function universityView(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                        ->first();
        $university = University::all();
        return view('admin.report.university',compact('admin','university'));
    }

    public function downloadUnivReport(Request $request)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
        ]);
        
        $university = University::find($request->university_id);
        $students = Student::where('university_id',$university->university_id)->get();
        $totalStudents =  count($students);
        $teachers = Teacher::where('university_id',$university->university_id)->get();
        $totalTeachers =  count($teachers);
        $accounts = Account::where('university_id',$university->university_id)->get();
        $totalAccounts =  count($accounts);
        $subjects = Subject::where('university_id',$university->university_id)->get();
        $totalSubjects = count($subjects);

        $pdf = \App::make('dompdf.wrapper');
        //PDF Text
            $html ='
            <style>
           
                .formTable
                    {
                        table-layout:fixed; 
                        font-size:16px; 
                        width: 100%; 
                        margin:2%;
                        word-wrap: break-word;
                        
                        box-sizing: border-box;

                    }
                    td {
                        padding: 10px;
                        border: 1px solid black;
                        border-collapse: collapse;
                      }
            </style>
            <h1 style="text-transform:uppercase; color:#076959;" align=center> Report of '.$university->name.' Univeristy</h1>';
            $html .='<table class="formTable">
            
            <tbody>
                <tr>
                    <td colspan="2">Total Number of Student:</td>
                    <td>'.$totalStudents.'</td>
                </tr>
                <tr>
                    <td colspan="2">Total Number of Teacher:</td>
                    <td>'.$totalTeachers.'</td>
                </tr>
                <tr>
                    <td colspan="2">Total Number of Accountants:</td>
                    <td>'.$totalAccounts.'</td>
                </tr>
                <tr>
                    <td colspan="2">Total Number of Subjects:</td>
                    <td>'.$totalSubjects.'</td>
                </tr>
                <tr>
                    <td colspan="2">University Added To Server AT:</td>
                    <td>'.$university->created_at.' (GMT +6 STANDARD DHAKA ASIA TIME)</td>
                </tr>
            </tbody>
        </table>';

        //END OF PDF TEXT
        $pdf->loadHTML($html);
        $name = time().'.pdf';
        return $pdf->download("Report".$name);
    }
}
