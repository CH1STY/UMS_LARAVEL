<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Notice;

class AdminNoticeController extends Controller
{
    public function addNotice(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();
        return view('admin.notice.addNotice',compact('admin'));
    }

    public function addNoticeVerify(Request $request)
    {   
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $request->validate([
            'details' => 'required|max:200',
        ]);

        $newNotice = new Notice;
        
        $noticeId = Notice::orderBy('notice_id',"desc")->first();

        if($noticeId)
        {
            $noticeId = intval(substr($noticeId->notice_id,2,5))+1;
            $noticeId = "NT".strval($noticeId);
            
        }
        else
        {
            $noticeId = "NT1000";
        }

        $newNotice->notice_id = $noticeId;
        $newNotice->details = $request->details;
        $newNotice->admin_id = $admin->admin_id;
        $newNotice->save();
        $request->details = "<table class='table'> <tr><td>".$request->details."</td></tr></table>";
        $request->session()->flash('postedData',$request->details);
        return Back();
    }

    public function viewNotices(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();
        $sortType="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='notice_id'|| $sort=='admin_id' || $sort=='details' || $sort=='created_at' )
            {

                if($request->has('sortType'))
                {
                    $sortType =  $request->get('sortType');
                    if($sortType=='asc' || $sortType=='desc')
                    {
                        //pass
                    }
                    else
                    {
                        $noticeList = Notice::paginate(7);
                        return view('admin.notice.view',compact('admin','noticeList','sortType'));
                    }
                } 
                else
                {
                    $sortType = 'asc';
                }
                
                $noticeList = Notice::orderBy($sort,$sortType)->paginate(7)->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                
            }
            else
            {
                
                $noticeList = Notice::paginate(7);
            }
        }else
        {
            
            
            $noticeList = Notice::paginate(7);
        }

        return view('admin.notice.viewNotice',compact('admin','noticeList','sortType'));
    }

    public function delete(Request $request, $notice_id)
    {

        $notice = Notice::where('id',$notice_id);
        if($notice)
        {
            $notice->delete();
            $request->session()->flash('msg',"Notice Deleted Successfully");

        }
        
        return Back();
    }
}
