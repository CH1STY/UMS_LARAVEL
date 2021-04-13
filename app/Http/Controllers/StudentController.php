<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\studentProfileRequest;
use App\Http\Requests\applyCourseRequest;
use App\Student;
use App\Department;
use App\StudentCourse;
use App\ApplyCourse;
use App\Course;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
                    ->first();
        return view('student.student',compact('student'));
    }

    public function profile(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
                ->first();
        $st = $student;
        $sd = $student->department_id;
        $department = Department::where('department_id',$sd)
                ->first();
        $std = $department->name;
        return view('student.studentProfile',compact('student','st','sd','department','std'));
    }

    public function edit(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
                    ->first();
        return view('student.edit',compact('student'));
    }

    
    public function profileUpdate(studentProfileRequest $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
                    ->first();


        if($request->profile_pic)
        {
            if($student->profile_pic) {
                unlink($student->profile_pic);
            }
            $extension = $request->profile_pic->getClientOriginalExtension();
            $fileName = date('U').'.'.$extension;
            $destination = "images/student/";
            $request->profile_pic->move($destination, $fileName);
            $student->profile_pic = $destination.$fileName;

        }

        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->address = $request->address;

        $student->save();
        $request->session()->flash('msg','Profile Updated Sucessfully!');
        return redirect ()->route('student.profile');

    }

    public function applyCourse(Request $request)
    {
        $student = Student::where('username',$request->session()->get('username'))
                ->first();
        $courseList = Course::all();
        return view('student.view.courseApply',compact(['student','courseList']));
    }

    public function applyCourseVerify(Request $request)
    {
        $newUser = new ApplyCourse;

        $lastUserId = ApplyCourse::select('apply_course_id')
                        ->orderBy('apply_course_id','DESC')
                        ->first();

        $lastUserId = intval(substr($lastUserId->apply_course_id,1,4));
        $lastUserId = $lastUserId+1;
        $newUser->apply_course_id ="AP".$lastUserId;
        $newUser->course1_id = $request->course1_id;
        $newUser->course2_id = $request->course2_id;
        $newUser->course3_id = $request->course3_id;
        $newUser->course4_id = $request->course4_id;
        $newUser->status = "applied";
        $newUser->student_id = (Student::where('username',$request->session()->get('username'))->first())->student_id;

        if($newUser->save()){
           $request->session()->flash('msg',"Successfuly Applied!");
        }
        else
        {
            
            $request->session()->flash('msg',"Apply Failed!");
        }



        return Back();
        
    }
}
