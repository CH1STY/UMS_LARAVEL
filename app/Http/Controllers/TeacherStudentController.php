<?php

namespace App\Http\Controllers;
use App\Exports\StudentReportExport;
use App\Exports\StudentAttendenceExport;
use App\Imports\StudentAttendenceImport;
use App\Student;
use App\StudentCourse;
use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherCourse;
use DB;
use Excel;


class TeacherStudentController extends Controller
{
    public function viewStudent(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teacherCourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)
                                       ->get();

        $student = DB::table('teacher_courses','student_courses','teacher')
                    ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                    ->join('student_courses', 'student_courses.course_id','=','teacher_courses.course_id')
                    ->SELECT ('teacher_courses.course_id','student_courses.student_id',
                             'teacher_courses.status')
                    ->get();

        return view('teacher.viewStudent',compact('teacher','student'));
    }

    public function studentlist(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();

        $student = DB::table('student_courses','students')
                    ->join('students', 'students.student_id','=','student_courses.student_id')
                    ->SELECT ('student_courses.course_id','student_courses.student_id',
                             'students.name', 'students.credits_completed','students.status')
                    ->where('student_courses.course_id','=',$id)
                    ->get();

        return view('teacher.studentlist',compact('teacher','student'));
    }

    public function studentdetails(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $student = Student::where('student_id',$id)->first();

        return view('teacher.studentdetails',compact('teacher','student'));
    }

    public function studentdrop(Request $req,$id)
    {
        $list = StudentCourse::where('student_id',$id)->first();
        $req->session()->flash('delete','STUDENT ID '.$id.' DROPPED SUCESSFULLY');
        $list->status = "dropped";
        return Back();
    }

    public function addstudentcourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teachercourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)->first();
        $student = StudentCourse::where('course_id',$teachercourse->course_id)
                                        ->where('status','pending')
                                        ->get();

       return view('teacher.addstudentcourse',compact('teacher','student'));
    }

    public function addedstudentcourse(Request $request,$id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        $teachercourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)->first();
        $std = StudentCourse::where('course_id',$teachercourse->course_id)
                                        ->where('status','pending')
                                        ->where('student_id',$id)
                                        ->first();

        $std->status = 'active';
        $std->save();
        return back();
    }

    public function StudentReport(){
        $report = time().'.xlsx';
        return Excel::download(new StudentReportExport,$report);
    }

    public function attendence(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                    ->first();
        return view('teacher.attendence',compact('teacher'));
    }
    public function StudentAttendence(){
        $attendence = time().'.xlsx';
        return Excel::download(new StudentAttendenceExport,$attendence);
    }

    public function importAttendence(Request $request)
    {
        Excel::import(new StudentAttendenceImport, $request->file);
        return back()->with('success', 'Attendence uploaded successfully!');
    }

}
