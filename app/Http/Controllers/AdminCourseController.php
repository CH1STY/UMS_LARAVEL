<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Admin;
use App\Subject;
use App\Course;
use App\University;
use App\Department;

class AdminCourseController extends Controller
{
    public function addSubject(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $universityList = University::all();
        $departmentList = Department::all();

        return view('admin.course.addSubject',compact('admin','universityList','departmentList'));
    }

    public function addSubjectVerify(Request $request)
    {    
       
        $request->validate([
            'name' => 'required|regex:/^[\pL\s.,\-]+$/u|min:4|max:35|min:4',
            'university_id' => 'required|exists:universities,university_id',
            'department_id' => 'required|exists:departments,department_id',
        ]);
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();
        $newSubject = new Subject;

        $newSubId = Subject::orderBy('subject_code','desc')
                    ->first();
        if($newSubId)
        {
            $newSubId = intval(substr($newSubId->subject_code,2,4));
            $newSubId = $newSubId+1;
            $newSubId = "SB".strval($newSubId);
        }
        else
        {
            $newSubId = "SB100";
        }

        $newSubject->subject_code = $newSubId;
        $newSubject->name = $request->name;
        $newSubject->university_id = $request->university_id;
        $newSubject->department_id = $request->department_id;
        $newSubject->admin_id = $admin->admin_id;

        if($newSubject->save())
        {
            
            $request->session()->flash('msg','Subject Added Successfully');
        }
        else
        {
            $request->session()->flash('msg','Can Not Add Subject');
        }

        return Back();

    }


    public function addCourse(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $subjectList = Subject::all();

        return view('admin.course.addCourse',compact('admin','subjectList'));
    }
    public function addCourseVerify(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|min:4|max:35|min:4',
            'subject_code' => 'required|exists:subjects,subject_code',
            'semester' => 'required|in:Spring,Fall,Summer',
            'credits' => 'required|numeric|max:5|min:1',
            'prerequisite' => 'exists:subjects,subject_code',
           
        ]);
        
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $newCourse = new Course;

        $newCourse->name = $request->name;
        $getCourseId = Course::orderBy('course_id','desc')->first();

        if($getCourseId)
        {
            $getCourseId = intval(substr($getCourseId->course_id,2,4));
            $getCourseId = $getCourseId+1;
            $getCourseId = "CL".strval($getCourseId);
        }
        else
        {
            $getCourseId = "CL100";
        }
        
        $newCourse->course_id = $getCourseId;
        if($request->subject_code)
        {
            $newCourse->subject_code = $request->subject_code;
            $department_id = Subject::where('subject_code',$request->subject_code)->first()->department_id;
            $newCourse->department_id = $department_id;
        }

        if($request->prerequisite)
        {
            $newCourse->prerequisite = $request->prerequisite;
        }
        else
        {
            $newCourse->prerequisite = "NONE";
        }

        $newCourse->admin_id = $admin->admin_id;
        $newCourse->semester = $request->semester.date("Y");
        $newCourse->credits = $request->credits;

        if($newCourse->save())
        {
            $request->session()->flash('msg','Course Added Successfully');

        }
        else
        {
            $request->session()->flash('msg','Course Adding Failed');

        }

        return Back();
    }

    public function viewCourseAndSubject(Request $request)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
        ->first();

        $sortType ="";

        $courseList = Course::join('subjects','courses.subject_code','=','subjects.subject_code')
                        ->join('departments','subjects.department_id','=','departments.department_id')
                        ->join('universities','departments.university_id','=','universities.university_id')
                        ->select('courses.name as cname','departments.name as cdname','universities.name as cuname','subjects.name as csname','courses.semester as csemester');
                        
        if($request->sortType)
        {
            $sortType = $request->sortType;
        }

        $courseList = $courseList->paginate(3)
                                    ->appends(['sortTab'=> $request->sortTab,'sort'=>$request->sort, 'sortType' => $request->sortType ]);

       return view('admin.course.CourseAndSubject',compact('admin','sortType','courseList'));


    }
}
