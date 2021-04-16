<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Teacher;
use App\Account;
use App\Student;
use App\RegistrationControl;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        
        if($request->session()->has('username') && $request->session()->has('usertype'))
        {
            $usertype = $request->session()->get('usertype');

            if($usertype=='admin')
            {
                return redirect()->route('admin');
            }
            else if($usertype=='teacher')
            {
                return redirect()->route('teacher');
            }
            else if($usertype=='student')
            {
                return redirect()->route('student');
            }
            else if($usertype=='account')
            {
                return redirect()->route('account');
            }
        }
        else
        {
            $isRegistration = RegistrationControl::find(1);
            if($isRegistration->status=='active')
            {
                $isRegistration = true;
            }
            else
            {
                $isRegistration = false;

            }
            return view('login.index',compact('isRegistration'));
        }

        
    }
    
    public function verify(Request $request)
    { 
        if($user = Admin::where('username',$request->username)
        ->where('password',$request->pass)
        ->first())
        {
            $request->session()->put('username',$user->username);
            $request->session()->put('usertype','admin');
            return redirect()->route('admin');
        }
        else if($user = Teacher::where('username',$request->username)
        ->where('password',$request->pass)
        ->first())
        {
            $request->session()->put('username',$user->username);
            $request->session()->put('usertype','teacher');
            return redirect()->route('teacher');
        }
        else if($user = Account::where('username',$request->username)
        ->where('password',$request->pass)
        ->first())
        {
            $request->session()->put('username',$user->username);
            $request->session()->put('usertype','account');
            return redirect()->route('account');

        }
        else if($user = Student::where('username',$request->username)
        ->where('password',$request->pass)
        ->where('status','active')
        ->first())
        {
            $request->session()->put('username',$user->username);
            $request->session()->put('usertype','student');
            return redirect()->route('student');
        }
        else
        {
            
            $request->session()->flash('msg','Invalid Login Attempt!');
            return redirect()->route('login');
        }
    }
}
