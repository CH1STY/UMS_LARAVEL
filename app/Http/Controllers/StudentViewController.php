<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Course;
use App\StudentCourse;

class StudentViewController extends Controller
{
    public function viewCourse(Request $request)
    {
        
        $student = Student::where('username',$request->session()->get('username'))
                    ->first();
        
        $dept = $student->department_id;
        
        $data = Course::select('name','course_id','prerequisite')
                    ->where('department_id',$dept)
                    ->orderBy('name','asc')
                    ->paginate(7);
        //End Of Sorting

       
        return view('student.view.viewCourse',compact('student','data'));
    }

    public function viewCourseGrade(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
        ->first();

        $st = $student->student_id;


        $data = Course::join('student_courses','courses.course_id','=','student_courses.course_id')
                        ->where('student_courses.student_id',$st)
                        ->select('courses.name as cname','courses.course_id as cid','student_courses.marks as cmarks');
        
        $data = $data->paginate(7);
       return view('student.view.viewCourseGrade',compact('student','data'));
    }

    public function viewCompletedCourse(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
        ->first();

        $st = $student->student_id;


        $data = Course::join('student_courses','courses.course_id','=','student_courses.course_id')
                        ->where('student_courses.student_id',$st)
                        ->where('student_courses.status','completed')
                        ->select('courses.name as cname','courses.course_id as cid','student_courses.marks as cmarks');
        
        $data = $data->paginate(7);
       return view('student.view.viewCourseGrade',compact('student','data'));
    }

    public function viewDropedCourse(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
        ->first();

        $st = $student->student_id;


        $data = Course::join('student_courses','courses.course_id','=','student_courses.course_id')
                        ->where('student_courses.student_id',$st)
                        ->where('student_courses.status','dropped')
                        ->select('courses.name as cname','courses.course_id as cid','student_courses.marks as cmarks');
        
        $data = $data->paginate(7);
       return view('student.view.viewCourseGrade',compact('student','data'));
    }
}
