<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\registrationRequest;
use App\University;
use App\Department;
use App\Student;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $universityList = University::all();
        $departmentList = Department::all();

        return view('registration.registration',compact(['universityList','departmentList']));    
    }

    public function registrationVerify(registrationRequest $request)
    {
        $newUser = new Student;

        $newUser->name = $request->name;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->password = $request->password;
        $newUser->address = $request->address;

        $lastUserId = Student::select('student_id')
                        ->orderBy('student_id','DESC')
                        ->first();

        $lastUserId = intval(substr($lastUserId->student_id,1,4));
        $lastUserId = $lastUserId+1;
        $newUser->student_id ="S".$lastUserId;
        $newUser->status = "pending";
        $newUser->address = $request->address;
        $newUser->balance = 0;
        $newUser->admission_date = $request->admission_date;
        $newUser->birthdate = $request->birthdate;
        $newUser->university_id = $request->university_id;
        $newUser->department_id = $request->department_id;
        if($newUser->save()){
           $request->session()->flash('msg',"Registration Successful!Wait For Confirmation. Username: ".$newUser->username);
        }
        else
        {
            
            $request->session()->flash('msg',"Registration Failed!");
        }



        return Back();
        
    }
}
