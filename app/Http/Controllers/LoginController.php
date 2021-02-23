<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('login.index');
        
    }
    
    public function verify(Request $request)
    {
        $request->session()->flash('msg','Invalid Login Attempt!');
        return redirect('/login');
    }
}
