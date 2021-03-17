<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\createAdminRequest;
use App\Http\Requests\createAccountRequest;
use App\Http\Requests\createStudentRequest;
use App\Admin;
use App\Teacher;
use App\Student;
use App\Account;
use App\University;
use App\Department;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        $adminList = Admin::orderBy('created_at',"DESC")
                    ->take(5)->get();
        $accountList = Account::orderBy('created_at',"DESC")
                    ->take(5)->get();
        $teacherList = Teacher::orderBy('created_at',"DESC")
                    ->take(5)->get();
        $universityList = University::orderBy('created_at',"DESC")
                    ->take(5)->get();
        $studentList = Student::orderBy('created_at',"DESC")
                    ->take(5)->get();
        return view('admin.admin',compact(['admin', 'adminList','accountList','teacherList','universityList','studentList']));
    }

    public function profile(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        $ad = $admin;
        return view('admin.admin.profile',compact('admin','ad'));
    }
    public function profileVerify(Request $request)
    {       
        $request->validate([
            'profile_pic' => 'required|mimes:jpg,png|max:5000',
        ]);

        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        if($request->profile_pic)
            {
                $profile_picExtension = $request->file('profile_pic')->extension();
                $destination = 'images/admin';
                $fileName = $admin->admin_id.date('U').".".$profile_picExtension;
                $request->profile_pic->move($destination,$fileName);
                
                if($admin->profile_pic)
                {
                    unlink($admin->profile_pic);
                }
                $admin->profile_pic = $destination."/".$fileName;
            }
        if($admin->save())
        {
            $request->session()->flash('msg',"Admin Picture Updated");

        }
        else
        {
            $request->session()->flash('msg',"Admin Picture Update Failed");
                
        }
        return Back();
    }

    public function createAdmin(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        return view('admin.createAdmin',compact(['admin']));
        
    }

    public function createAdminVerify(createAdminRequest $request)
    {
        $newUser = new Admin;

        $newUser->name = $request->name;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->password = $request->password;
        $newUser->address = $request->address;

        $lastAdminId = Admin::select('admin_id')
                        ->orderBy('admin_id','DESC')
                        ->first();

        $lastAdminId = intval(substr($lastAdminId->admin_id,1,3));
        $lastAdminId = $lastAdminId+1;
        $newUser->admin_id ="A".$lastAdminId;
        $newUser->status = "active";
        $newUser->address = $request->address;
        if($newUser->save()){
           $request->session()->flash('msg',"Admin Added Successfully! Username: ".$newUser->username);
        }
        else
        {
            
            $request->session()->flash('msg',"Admin Addeding Failed!");
        }



        return Back();
        
    }

    public function createAccount(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        $universityList = University::all();

        return view('admin.createAccount',compact(['admin','universityList']));

    }

    public function createAccountVerify(createAccountRequest $request)
    {
        $newUser = new Account;

        $newUser->name = $request->name;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->password = $request->password;
        $newUser->address = $request->address;

        $lastUserId = Account::select('account_id')
                        ->orderBy('account_id','DESC')
                        ->first();

        $lastUserId = intval(substr($lastUserId->account_id,2,4));
        $lastUserId = $lastUserId+1;
        $newUser->account_id ="AC".$lastUserId;
        $newUser->status = "active";
        $newUser->address = $request->address;
        $newUser->salary = $request->salary;
        $newUser->birthdate = $request->birthdate;
        $newUser->admin_id = (Admin::where('username',$request->session()->get('username'))->first())->admin_id;
        $newUser->university_id = $request->university_id;
        if($newUser->save()){
           $request->session()->flash('msg',"Account Added Successfully! Username: ".$newUser->username);
        }
        else
        {
            
            $request->session()->flash('msg',"Account Addeding Failed!");
        }



        return Back();
        
    }


    public function createTeacher(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        $universityList = University::all();
        return view('admin.createTeacher',compact(['admin','universityList']));
    }

    public function createTeacherVerify(createAccountRequest $request)
    {
        $newUser = new Teacher;

        $newUser->name = $request->name;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->password = $request->password;
        $newUser->address = $request->address;

        $lastUserId = Teacher::select('teacher_id')
                        ->orderBy('teacher_id','DESC')
                        ->first();

        $lastUserId = intval(substr($lastUserId->teacher_id,1,3));
        $lastUserId = $lastUserId+1;
        $newUser->teacher_id ="T".$lastUserId;
        $newUser->status = "active";
        $newUser->address = $request->address;
        $newUser->salary = $request->salary;
        $newUser->balance = 0;
        $newUser->birthdate = $request->birthdate;
        $newUser->admin_id = (Admin::where('username',$request->session()->get('username'))->first())->admin_id;
        $newUser->university_id = $request->university_id;
        if($newUser->save()){
           $request->session()->flash('msg',"Account Added Successfully! Username: ".$newUser->username);
        }
        else
        {
            
            $request->session()->flash('msg',"Account Addeding Failed!");
        }



        return Back();
        
    }

    public function createStudent(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        $universityList = University::all();
        $departmentList = Department::all();
        return view('admin.createStudent',compact(['admin','universityList','departmentList']));
    }

    public function createStudentVerify(createStudentRequest $request)
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
        $newUser->admin_id = (Admin::where('username',$request->session()->get('username'))->first())->admin_id;
        $newUser->university_id = $request->university_id;
        $newUser->department_id = $request->department_id;
        if($newUser->save()){
           $request->session()->flash('msg',"Account Added Successfully! Username: ".$newUser->username);
        }
        else
        {
            
            $request->session()->flash('msg',"Account Addeding Failed!");
        }



        return Back();
        
    }
    
}
