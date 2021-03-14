<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Teacher;
use App\Student;
use App\Account;
use App\University;

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
}
