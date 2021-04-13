<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Note;
use Illuminate\Http\Request;
use App\Teacher;
use App\Assignment;
use App\AssignmentCollection;
use App\StudentCourse;
use App\TeacherCourse;
use DB;

class CourseController extends Controller
{
    public function teacherCourselist(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();


        $course = DB::table('courses','departments')
                    ->join('departments', 'departments.department_id','=','courses.department_id')
                    ->SELECT ('courses.course_id', 'departments.name as dname', 'courses.subject_code',
                    'courses.name', 'courses.credits', 'courses.created_at')
                    ->paginate(10);


        return view('teacher.viewCourselist',compact('course','teacher'));
    }

    public function searchCourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        return view('teacher.searchCourse',compact('teacher'));
    }
    public function action(Request $request)
    {

        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('courses')
                    ->where('subject_code', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('credits', 'like', '%' . $query . '%')
                    ->orderBy('course_id', 'asc')
                    ->get();
            } else {
                $data = DB::table('courses')
                ->orderBy('course_id', 'asc')
                ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                                <tr>
                                <td>' . $row->course_id . '</td>
                                <td>' . $row->name . '</td>
                                <td>' . $row->credits . '</td>
                                <td>' . $row->created_at . '</td>
                                <td> <a href="">
                                        <button class="btn btn-success">Details</button></a>
                                </td>
                                </tr>';
                }
            } else {
                $output = '<tr><td align="center" colspan="5">No Data Found</td></tr>';
            }

            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function teacherCourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();


        $course = DB::table('courses','teacher_courses','departments')
                ->join('teacher_courses', 'teacher_courses.course_id','=','courses.course_id')
                ->join('departments', 'departments.department_id','=','courses.department_id')
                ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                ->SELECT ('courses.course_id', 'departments.name as dname','courses.name',
                  'courses.credits', 'courses.created_at','teacher_courses.status');

        $order="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='course_id' || $sort=='credits' || $sort=='dname' || $sort=='created_at' || $sort=='status')
            {
                if($request->has('order'))
                {
                    $order =  $request->get('order');
                }
                else
                {
                    $order = 'asc';
                }
                $course = $course->orderBy($sort,$order)
                                ->paginate(10)
                                ->appends(['sort'=> $sort, 'order'=>$order]);
            }
            else
            {
                $course = $course->paginate(10);
            }

        }
        else
        {
            $course = $course->paginate(10);
        }
        return view('teacher.viewMyCourselist',compact('course','teacher','order'));
    }

    public function courseDetails(Request $request, $course_id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $course = DB::table('courses','teacher_courses','departments', 'subjects')
                ->join('teacher_courses', 'teacher_courses.course_id','=','courses.course_id')
                ->join('departments', 'departments.department_id','=','courses.department_id')
                ->join('subjects', 'subjects.subject_code','=','courses.subject_code')
                ->SELECT ('courses.course_id', 'departments.name as dname', 'subjects.name as sname',
                        'courses.subject_code', 'courses.prerequisite', 'courses.semester',
                        'courses.name','courses.credits', 'courses.created_at','teacher_courses.status')
                ->where('courses.course_id',$course_id)
                ->get()[0];
        return view('teacher.courseDetails',compact('teacher','course'));

    }

    public function noteCourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();

        $course = DB::table('courses','teacher_courses')
                ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                ->join('teacher_courses', 'teacher_courses.course_id','=','courses.course_id')
                ->SELECT ('courses.course_id','courses.name',
                  'courses.credits', 'courses.created_at','teacher_courses.status')
                ->paginate(10);

        return view('teacher.noteCourse',compact('teacher','course'));
    }

    public function noteUpload(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();

        $course = Course::where('course_id',$id)->first();
        $note = Note::where('course_id',$id)
                    ->where('teacher_id',$teacher->teacher_id)
                    ->get();

        return view('teacher.noteUpload',compact('teacher','course','note'));
    }

    public function noteUploadPost(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $course = Course::where('course_id',$id)->first();

        $request->validate([
                'file' => 'required|mimes:pdf,xlx,csv,doc|max:2048',
            ]);

        $fileName = time().'.'.$request->file->extension();
        $destination = public_path('notes/teacher');
        $request->file->move($destination, $fileName);

        $cnt = Note::orderby('note_id','desc')->first();
        if($cnt)
        {
            $cnt = intval(substr($cnt->note_id,2,5));
            $cnt = $cnt+1;
            $cnt = "NT".strval($cnt);
        }
        else  $cnt = "NT1000";

        $note = new Note();
        $note->note_id = $cnt;
        $note->details = $destination."/".$fileName;
        $note->admin_id = $teacher->admin_id;
        $note->course_id = $course->course_id;
        $note->teacher_id = $teacher->teacher_id;
        $note->save();
        return back()->with('success','You have successfully upload file.')
                    ->with('file',$fileName);


    }

    public function notedownload(Request $request, $id)
    {
        $note = Note::where('note_id',$id)->first();
        return response()->download($note->details);
    }
     public function notedelete(Request $req,$id)
    {
        $list = Note::where('note_id',$id)->first();
        $req->session()->flash('delete','NOTE ID '.$id.' DELETED SUCESSFULLY');
        $list->delete();
        return Back();
    }

    public function assignmentCourse(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();

        $course = DB::table('courses','teacher_courses')
                ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                ->join('teacher_courses', 'teacher_courses.course_id','=','courses.course_id')
                ->SELECT ('courses.course_id','courses.name',
                  'courses.credits', 'courses.created_at','teacher_courses.status')
                ->paginate(10);

        return view('teacher.assignmentCourse',compact('teacher','course'));
    }

    public function assignmentUpload(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $course = Course::where('course_id',$id)->first();
        $assignment = Assignment::where('course_id',$id)
                    ->where('teacher_id',$teacher->teacher_id)
                    ->get();

        return view('teacher.assignmentUpload',compact('teacher','course','assignment'));
    }

    public function assignmentUploadPost(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $course = Course::where('course_id',$id)->first();

        $request->validate([
                'file' => 'required|mimes:pdf,xlx,csv,docx,doc|max:2048',
            ]);

        $fileName = time().'.'.$request->file->extension();
        $destination = public_path('assignment/teacher');
        $request->file->move($destination, $fileName);

        $cnt = Assignment::orderby('assignment_id','desc')->first();
        if($cnt)
        {
            $cnt = intval(substr($cnt->assignment_id,2,5));
            $cnt = $cnt+1;
            $cnt = "AC".strval($cnt);
        }
        else  $cnt = "AC1000";

        $assignment = new Assignment();
        $assignment->assignment_id = $cnt;
        $assignment->details = $destination."/".$fileName;
        $assignment->admin_id = $teacher->admin_id;
        $assignment->course_id = $course->course_id;
        $assignment->teacher_id = $teacher->teacher_id;
        $assignment->save();
        return back()->with('success','You have successfully upload file.')
                    ->with('file',$fileName);

    }

    public function assignmentdownload(Request $request, $id)
    {
        $assignment = Assignment::where('assignment_id',$id)->first();
        return response()->download($assignment->details);
    }

    public function assignmentcollect(Request $request, $id)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $assignment = AssignmentCollection::where('assignment_id',$id)->get();
        //print_r($assignment);
        return view('teacher.assignmentcollect',compact('assignment','teacher'));
    }

     public function assignmentdelete(Request $req,$id)
    {
        $list = Assignment::where('assignment_id',$id)->first();
        $req->session()->flash('delete','ASSIGNMENT ID '.$id.' DELETED SUCESSFULLY');
        $list->delete();
        return Back();
    }

    public function dropRequest(Request $request)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $drop = DB::table('student_courses','teacher_courses')
                            ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                            ->join('teacher_courses', 'teacher_courses.course_id','=','student_courses.course_id')
                            ->where('student_courses.status','dropping')
                            ->paginate(10);

        return view('teacher.dropRequest',compact('teacher','drop'));
    }

    public function dropping(Request $request,$cid,$sid)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $drop = DB::table('student_courses','teacher_courses')
                            ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                            ->join('teacher_courses', 'teacher_courses.course_id','=','student_courses.course_id')
                            ->where('student_courses.status','dropping')
                            ->paginate(10);
        $drop = StudentCourse::where('student_id',$sid)
                              ->where('course_id',$cid)
                              ->where('status','dropping')
                              ->first();
        $drop->status = 'dropped';
        $drop->save();

        return back();
    }

    public function droppingCancel(Request $request,$cid,$sid)
    {
        $teacher = Teacher::where('username',$request->session()->get('username'))
                            ->first();
        $drop = DB::table('student_courses','teacher_courses')
                            ->where('teacher_courses.teacher_id',$teacher->teacher_id)
                            ->join('teacher_courses', 'teacher_courses.course_id','=','student_courses.course_id')
                            ->where('student_courses.status','dropping')
                            ->paginate(10);
        $drop = StudentCourse::where('student_id',$sid)
                              ->where('course_id',$cid)
                              ->where('status','dropping')
                              ->first();
        $drop->status = 'active';
        $drop->save();

        return back();
    }

}
