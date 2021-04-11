<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\TeacherProfileRequest;
use App\Http\Requests\ProPicRequest;
use App\Student;
use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherCourse;

class TeacherController extends Controller
{
    //
    public function index(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teacherCourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)
                                       ->where('status','active')
                                       ->get();

        $course = Course::all();

        return view('teacher.index',compact('teacher','course','teacherCourse'));
    }

    public function profile(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        return view('teacher.profile',compact('teacher'));
    }

    public function edit(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        return view('teacher.edit',compact('teacher'));
    }

    public function profileUpdate(TeacherProfileRequest $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();


        if($request->profile_pic)
        {
            if($teacher->profile_pic) {
                unlink($teacher->profile_pic);
            }
            $extension = $request->profile_pic->getClientOriginalExtension();
            $fileName = date('U').'.'.$extension;
            $destination = "images/teacher/";
            $request->profile_pic->move($destination, $fileName);
            $teacher->profile_pic = $destination.$fileName;

        }

        $teacher->name = $request->name;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->address = $request->address;

        $teacher->save();
        $request->session()->flash('msg','Profile Updated Sucessfully!');
        return redirect ()->route('teacher.profile');

    }


    public function resignRequest(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        return view('teacher.resignRequest',compact('teacher'));
    }

    public function resigning(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teacher->status = 'resigning';
        $teacher->save();
        return back();
    }

    public function deleteResigning(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teacher->status = 'active';
        $teacher->save();
        return back();
    }


}
