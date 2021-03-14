<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
                    ->first();
        return view('student.student',compact('student'));
    }
}
