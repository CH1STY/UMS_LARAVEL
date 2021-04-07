<?php

namespace App\Http\Controllers;

use App\Account;
use App\Course;
use App\Student;
use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherCourse;
use DB;

class TeacherAccountController extends Controller
{
    public function viewAccount(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();

        $account = Account::where('username',$teacher->username)->first();

        return view('teacher.viewAccount',compact('teacher','account'));
    }

}
