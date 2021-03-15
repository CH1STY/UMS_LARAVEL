<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Teacher;
use App\Student;
use App\Account;
use App\University;
use App\Department;
use App\Subject;
use App\Note;
use App\Course;
use App\StudentCourse;
use App\TeacherCourse;

class AdminModifyController extends Controller
{
    public function viewUniversity(Request $request)
    {
        
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        //Sorting part
        $sortType="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='university_id' || $sort=='address' || $sort=='admin_id' || $sort=='created_at')
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
                        $universityList = University::paginate(7);
                        return view('admin.modify.viewUniveristy',compact('admin','universityList','sortType'));
                    }
                } 
                else
                {
                    $sortType = 'asc';
                }
                
                $universityList = University::orderBy($sort,$sortType)->paginate(7)->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                
            }
            else
            {
                
                $universityList = University::paginate(7);
            }
        }else
        {
            
            $universityList = University::paginate(7);
        }
        //End Of Sorting


        return view('admin.modify.viewUniveristy',compact('admin','universityList','sortType'));
    }

    public function editUniversity(Request $request, $univ_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();

        $university = University::find($univ_id);
        
        return view('admin.modify.editUniversity',compact('admin','university'));
    }
    
    public function editUniversityVerify(Request $request, $univ_id)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s.,\-]+$/u|min:4|max:35',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'profile_pic' => 'mimes:jpg,png|max:5000',
        ]);

        $university = University::find($univ_id);
        
        if(empty($university))
        {
            $request->session()->flash('msg',"University May No Longer Exist");
        }
        else if($university)
        {
            $university->name = $request->name;
            $university->address = $request->address;
            if($request->profile_pic)
            {
                $profile_picExtension = $request->file('profile_pic')->extension();
                $destination = 'images/university';
                $fileName = $university->university_id.date('U').".".$profile_picExtension;
                $request->profile_pic->move($destination,$fileName);
                
                if($university->profile_pic)
                {
                    unlink($university->profile_pic);
                }
                $university->profile_pic = $destination."/".$fileName;
            }
            if($university->save()){

                $request->session()->flash('msg',"University Information Updated");
            }
            else
            {
                $request->session()->flash('msg',"University Information Update Failed");
                
            }
            
        }

        return Back();
    }

    public function disableUniversity(Request $request,$univ_id)
    {
        
    }


    public function deleteUniversity(Request $request,$univ_id)
    {
        $university = University::find($univ_id);
        if($university)
        {
            // Deleting Student Part
            $studentList = Student::where('university_id',$university->university_id)->get();

            foreach($studentList as $student)
            {
                $studentCourseList = StudentCourse::where('student_id',$student->student_id)->get();

                foreach($studentCourseList as $studentCourse)
                {
                    $studentCourse->delete();
                }

                $student->delete();
            }
            //-------------
            
            // Deleting Teacher Part
            $teacherList = Teacher::where('university_id',$university->university_id)->get();

            foreach($teacherList as $teacher)
            {
                $teacherCourseList = TeacherCourse::where('teacher_id',$teacher->teacher_id)->get();

                foreach($teacherCourseList as $teacherCourse)
                {
                    $teacherCourse->delete();
                }

                $teacherNotesList = Note::where('teacher_id',$teacher->teacher_id)->get();

                foreach($teacherNotesList as $notes)
                {
                    $notes->delete();
                }


                $teacher->delete();
            }
            //-------------

            //Deleteing Accounts Parts
            
            $accountsList = Account::where('university_id',$university->university_id)->get();

            foreach($accountsList as $account)
            {
                $account->delete();
            }

            //----
            
            //deleting Department
            $departmentList = Department::where('university_id',$university->university_id)->get();
            
            foreach($departmentList as $department)
            {
                 
                  //Deleting Subject Parts
                  
                  $subjectList = Subject::where('university_id',$university->university_id)->orWhere('department_id',$department->department_id)->get();
      
                  foreach($subjectList as $subject)
                  {
                      $courseList = Course::where('subject_code',$subject->subject_code)->orWhere('prerequisite',$subject->subject_code)->get();
      
                      foreach($courseList as $course)
                      {
                          
                          $teacherCourseList = TeacherCourse::where('course_id',$course->course_id)->get();
          
                          foreach($teacherCourseList as $teacherCourse)
                          {
                              $teacherCourse->delete();
                          }
      
                          $studentCourseList = StudentCourse::where('course_id',$course->course_id)->get();
      
                          foreach($studentCourseList as $studentCourse)
                          {
                              $studentCourse->delete();
                          }
      
                          $course->delete();
                      }
      
                      $subject->delete();
      
                  }
      
                  //------------------------


                
                 $department->delete();
             }
 
             //----
 

            $request->session()->flash('msg',"All Information Deleted Which were related with University ID: ".$university->university_id);
            $university->delete();


        }
        else
        {
            $request->session()->flash('msg',"University Deletion Failed");

        }

        return redirect()->route('admin.view.university');
    }

}
