<?php

namespace App\Http\Controllers;
use App\Student;
use App\TeacherCourse;
use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherNotice;
use App\Course;
use App\Notice;
use DB;

class TeacherNoticeController extends Controller
{
    public function noticeadmin(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $notice = Notice::orderby('created_at','desc');

        return view('teacher.noticeadmin',compact('teacher','notice'));
    }

    public function noticeTeacher(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teachercourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)->first();
        $notice = TeacherNotice::where('teacher_course_id',$teachercourse->teacher_course_id)
                                ->orderby('created_at','desc')
                                ->get();

        return view('teacher.noticeTeacher',compact('teacher','notice'));
    }

    public function noticedelete(Request $request,$id)
    {
        $notice = TeacherNotice::where('teacher_notice_id',$id)->first();
        $request->session()->flash('noticedelete','NOTICE ID '.$id.' DELETED SUCESSFULLY');
        $notice->delete();
        return back();
    }

    public function noticeCourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();

        $course = DB::table('courses','teacher_courses')
                ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                ->join('teacher_courses', 'teacher_courses.course_id','=','courses.course_id')
                ->SELECT ('courses.course_id','courses.name',
                  'courses.credits', 'courses.created_at','teacher_courses.status')
                ->paginate(10);

        return view('teacher.noticeCourse',compact('teacher','course'));
    }

    public function noticeUpload(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $course = Course::where('course_id',$id)->first();
        return view('teacher.noticeUpload',compact('teacher','course'));
    }


    public function uploadNotice(Request $request,$id)
    {

        $request->validate([
            'details' => 'required|max:200|min:1',
            ]);

        $teacher = Teacher::where('username',$request->session()->get('username'))
                        ->first();
        $teachercourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)
                                        ->where('course_id',$id)
                                        ->first();
        $teacher_notice = new TeacherNotice;
        $cnt = TeacherNotice::orderBy('teacher_notice_id',"desc")->first();

        if($cnt)
        {
            $teacher_notice_id = intval(substr($cnt->teacher_notice_id,2,5))+1;
            $teacher_notice_id = "TN".strval($teacher_notice_id);
        }
        else $teacher_notice_id = "TN1000";

        $teacher_notice->teacher_notice_id = $teacher_notice_id;
        $teacher_notice->details = $request->details;
        $teacher_notice->teacher_course_id = $teachercourse->teacher_course_id;
        $teacher_notice->save();
        $request->session()->flash('uploaded',"Notice Successfully uploaded");
        return Back();
    }
}
