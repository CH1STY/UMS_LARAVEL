<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Http\Requests\TeacherProfileRequest;
use App\Http\Requests\ProPicRequest;
use App\Student;
use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherCourse;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function teacherCourselist(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        //$course = Course::paginate(10);

       /* $list = DB::select(DB::raw("SELECT courses.course_id, departments.name as dname, courses.subject_code,
                                           courses.name, courses.credits, courses.created_at
                                    FROM courses
                                    INNER JOIN departments
                                    ON courses.department_id=departments.department_id;"));
       // print_r($list[0]);*/


        //print_r($course[0]);
        $course = DB::table('courses','departments')
                    ->join('departments', 'departments.department_id','=','courses.department_id')
                    ->SELECT ('courses.course_id', 'departments.name as dname', 'courses.subject_code',
                    'courses.name', 'courses.credits', 'courses.created_at');

        $sortType="";
        if($request->has('sort'))
        {

            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='course_id' || $sort=='credits' || $sort=='dname' || $sort=='created_at')
            {

                if($request->has('sortType'))
                {
                    $sortType =  $request->get('sortType');
                }
                else
                {
                    $sortType = 'asc';
                }

                $course = $course->orderBy($sort,$sortType)
                                ->paginate(10)
                                ->appends(['sort'=> $sort, 'sortType'=>$sortType]);

            }
            else
            {
                $course ->paginate(10);
            }

        }
        else
        {
            $course ->paginate(10);
        }

        return view('teacher.viewCourselist',compact('course','teacher','sortType'));
    }

    public function teacherCourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $teacherCourse = TeacherCourse::where('teacher_id',$teacher->teacher_id)
                                        ->paginate(10);
        $course = Course::paginate(10);
        /*$course = DB::table('courses')
                    ->join('teacher_courses', 'teacher_courses.course_id','=','courses.course_id')
                    ->SELECT ('courses.course_id', 'courses.subject_code',
                    'courses.name', 'courses.credits', 'courses.created_at')
                    ->get()
                    ->paginate(10);*/

        $sortType="";
        if($request->has('sort'))
            {
                $sort = $request->get('sort');
                if($sort=='name'|| $sort=='course_id' || $sort=='credits' || $sort=='department_id' || $sort=='created_at')
                    {
                        if($request->has('sortType'))
                        {
                            $sortType =  $request->get('sortType');
                        }
                        else
                        {
                            $sortType = 'asc';
                        }

                        $course = Course::orderBy($sort,$sortType)
                                        ->paginate(10)
                                        ->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                        $teacherCourse = TeacherCourse::orderBy($sort,$sortType)
                                                    ->paginate(10)
                                                    ->appends(['sort'=> $sort, 'sortType'=>$sortType]);

                    }

             }

        return view('teacher.viewMyCourselist',compact('course','teacher','sortType','teacherCourse'));
    }

    public function courseDetails(Request $request, $course_id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $course = Course::get();

    }
}
