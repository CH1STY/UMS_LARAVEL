<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;


class AccountController extends Controller
{
  

    public function index(Request $request)
    {
        
        $account=Account::where('username',$request->session()->get('username'))
                            ->first();
        return view('account.account',compact('account'));

    }
    
}
