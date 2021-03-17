<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Subject;
use App\Course;
use App\University;
use App\Department;

class AdminCourseController extends Controller
{
    public function addSubject(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $universityList = University::all();
        $departmentList = Department::all();

        return view('admin.course.addSubject',compact('admin','universityList','departmentList'));
    }

    public function addSubjectVerify(Request $request)
    {   
        
    }
}
