<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Student;
use App\Course;
use App\StudentCourse;

class AdminStudentCourseController extends Controller
{
    public function addView(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                        ->first();
        $students = Student::all(); 
        
        return view('admin.student_course.add',compact('admin','students'));
    }

    public function addViewFetch(Request $request)
    {
        $student_id = $request->student_id;
        $data = Student::where('students.id',$student_id)
                        ->join('subjects','subjects.university_id','=','students.university_id')
                        ->join('courses','subjects.subject_code','courses.subject_code')
                        ->get();
        return view('admin.student_course.fetchCourseList',compact('data'));
    }

    public function addCourseVerify(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            
           
        ]);

        $student = Student::find($request->student_id);
        $course = Course::find($request->course_id);

        $student_course = new StudentCourse();
        $student_course->student_id = $student->student_id;
        $student_course->course_id = $course->course_id;
        $student_course->status = "active";
        $student_course->marks = 0;
        
        $student_course_id= StudentCourse::orderBy('student_course_id',"desc")->first();
        

        if($student_course_id)
        {
            $student_course_id = intval(substr($student_course_id->student_course_id,2,4))+1;
            $student_course_id = "SC".strval($student_course_id);
            
        }
        else
        {
            $student_course_id = "SC100";
        }
        
        $student_course->student_course_id = $student_course_id;

        if($student_course->save())
        {
            $request->session()->flash('msg','Student '.$student->student_id.' Added To Course '.$course->course_id);

        }
        else
        {
            $request->session()->flash('msg','Course Adding Failed');

        }



        return Back();
    }

    public function removeView(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                        ->first();
        $students = Student::all(); 
        
        return view('admin.student_course.drop',compact('admin','students'));
    }

    public function dropViewFetch(Request $request)
    {
        $student_id = $request->student_id;
        $student = Student::find($student_id);
        $data = StudentCourse::where('student_id',$student->student_id)
                ->where('status','active')
                ->join('courses','courses.course_id','=','student_courses.course_id')
                ->get();
                               
       
        return view('admin.student_course.fetchCurrCourseList',compact('data'));
    }

    public function removeVerify(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'student_course_id' => 'required|exists:student_courses,student_course_id',
        ]);

        $stdCsr = StudentCourse::where('student_course_id',$request->student_course_id)->first();



        if($stdCsr)
        {

            $stdCsr->status="dropped";
            $courseId = Course::where('course_id',$stdCsr->course_id)->first();
            $studentId = Student::find($request->student_id);
            if($stdCsr->save())
            {

                $request->session()->flash('msg','Student with id '.$studentId->student_id.' Dropped From Course: '.$courseId->course_id);
            }
            else
            {
                $request->session()->flash('msg','Course Dropping Failed');

            }

        }
        else
        {
            $request->session()->flash('msg','Course Dropping Failed');

        }
        
        return Back();
    }

}
