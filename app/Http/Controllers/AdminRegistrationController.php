<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationControl;
use App\Admin;

class AdminRegistrationController extends Controller
{
    //
    public function index(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $student_reg = RegistrationControl::find(1);
        $student_reg = $student_reg->status;

        $course_reg = RegistrationControl::find(2);
        $course_reg = $course_reg->status;


        return view('admin.registration.index',compact('admin','course_reg','student_reg'));
    }

    public function update(Request $request)
    {
        $course_reg = $request->course_reg;
        $student_reg = $request->student_reg;

        if($course_reg=="true")
        {
            $courseControl = RegistrationControl::find(2);
            $courseControl->status = "active";
            $courseControl->save();
            
        }
        else
        {
            $courseControl = RegistrationControl::find(2);
            $courseControl->status = "inactive";
            $courseControl->save();
            echo "I was called";
        }
        if($student_reg=="true")
        {
            $courseControl = RegistrationControl::find(1);
            $courseControl->status = "active";
            $courseControl->save();
            
        }
        else
        {
            $courseControl = RegistrationControl::find(1);
            $courseControl->status = "inactive";
            $courseControl->save();
            echo "I was called";
        }

        
    }
}
