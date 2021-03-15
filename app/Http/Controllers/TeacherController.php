<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherProfileRequest;
use App\Http\Requests\ProPicRequest;
use Illuminate\Http\Request;
use App\Teacher;

class TeacherController extends Controller
{
    //
    public function index(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();

        return view('teacher.index',compact('teacher'));
    }

    public function profile(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        return view('teacher.profile',compact('teacher'));
    }
    public function profilePicUp(ProPicRequest $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        if($teacher->profile_pic) {
            unlink($teacher->profile_pic);
        }
        $extension = $request->profile_picture->getClientOriginalExtension();
        $fileName = date('U').'.'.$extension;
        $destination = "images/teacher/";
        $request->profile_picture->move($destination, $fileName);
        $teacher->profile_pic = $destination.$fileName;
        $teacher->save();
        return Back();
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
        if($teacher->profile_pic) {
            unlink($teacher->profile_pic);
        }
        $extension = $request->profile_picture->getClientOriginalExtension();
        $fileName = date('U').'.'.$extension;
        $destination = "images/teacher/";
        $request->profile_picture->move($destination, $fileName);
        $teacher->profile_pic = $destination.$fileName;

        $teacher->name = $request->name;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->birthdate = $request->birthdate;
        $teacher->status = $request->status;
        $teacher->address = $request->address;

        $teacher->save();
        $request->session()->flash('msg','Profile Updated Sucessfully!');
        return view('teacher.profile',compact('teacher'));
    }

}
