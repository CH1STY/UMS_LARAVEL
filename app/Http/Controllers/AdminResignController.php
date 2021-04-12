<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;
use App\Teacher;
use App\Account;

class AdminResignController extends Controller
{
    public function index(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                        ->first();
        $data = Teacher::where('status','resigning')
                        ->select('teachers.teacher_id as empid','teachers.name as empname','teachers.updated_at as lastUp');
        $data = Account::where('status','resigning')
                        ->select('accounts.account_id as empid','accounts.name as empname','accounts.updated_at as lastUp')
                        ->union($data)
                        ->orderBy('lastUp','asc')
                        ->get();
        return view('admin.resign.index',compact('admin','data'));
    }

    public function fetch(Request $request)
    {
       
        
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = Teacher::where('status','resigning')
                ->select('teachers.teacher_id as empid','teachers.name as empname','teachers.updated_at as lastUp');
        $data = Account::where('status','resigning')
                ->select('accounts.account_id as empid','accounts.name as empname','accounts.updated_at as lastUp')
                ->union($data);
        

        if($query!="undefined")
        {
            $data =    $data->Where('name','like','%'.$query.'%');
                            
                            
        }            
        if($sort_by!='undefined' && $sort_type!='undefined')
        {
            $data = $data->orderBy($sort_by,$sort_type);
        }

        $data = $data->get();
        return view('admin.resign.fetch',compact('data'))->render();
    }
    public function accept(Request $request,$empid)
    {
        if(substr($empid,0,2)=='AC')
        {
            $account = Account::where('account_id',$empid)->first();

            $account->status = 'resigned';
            
            if($account->save())
            {

                $request->session()->flash('msg',"Account with ". $empid ." Resigned");
            }
        }
        else if(substr($empid,0,1)=='T')
        {
            $teahcer = Teacher::where('teacher_id',$empid)->first();

            $teahcer->status = 'resigned';
            
            if($teahcer->save())
            {

                $request->session()->flash('msg',"Teacher with ". $empid ." Resigned");
            }

            
        }
        return Back();
    }
    public function reject(Request $request,$empid)
    {
        
        if(substr($empid,0,2)=='AC')
        {
            $account = Account::where('account_id',$empid)->first();

            $account->status = 'active';
            
            if($account->save())
            {

                $request->session()->flash('msg',"Resign Application Denied For Accountant with ID:  ". $empid );
            }
        }
        else if(substr($empid,0,1)=='T')
        {
            $teahcer = Teacher::where('teacher_id',$empid)->first();

            $teahcer->status = 'active';
            
            if($teahcer->save())
            {

                $request->session()->flash('msg',"Resign Application Denied For Teacher with ID:  ". $empid );
            }
        }
        return Back();
    }
}
