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
        
        $data = Notice::select('id','notice_id','admin_id','created_at','details')
                    ->paginate(7);
        return view('admin.notice.viewNotice',compact('admin','data'));
    }

    public function fetchNotices(Request $request)
    {
        $data = Notice::select('id','notice_id','admin_id','created_at','details');
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        
       

        if($query!="undefined")
        {
            $data =    $data->orWhere('notice_id','like','%'.$query.'%')
                            ->orWhere('admin_id','like','%'.$query.'%')
                            ->orWhere('created_at','like','%'.$query.'%')
                            ->orWhere('details','like','%'.$query.'%');
        }            
        if($sort_by!='undefined' && $sort_type!='undefined')
        {
            $data = $data->orderBy($sort_by,$sort_type);
        }
        
                    
        $data= $data->paginate(7);

        return view('admin.notice.fetchNotices',compact('data'));
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
