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
            if($sort=='name'|| $sort=='university_id' || $sort=='address' || $sort=='admin_id' || $sort=='updated_at')
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

    public function detailsUniversity(Request $request,$univ_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        $university = University::find($univ_id);

        $totalEmployees = 0;
        $list = Account::where('university_id',$university->university_id)->get();
        $totalEmployees = $totalEmployees + count($list);
        $list = Teacher::where('university_id',$university->university_id)->get();
        $totalEmployees = $totalEmployees + count($list);

        $totalStudent =0;
        $list = Student::where('university_id',$university->university_id)->get();
        $totalStudent = $totalStudent + count($list);
        
        $totalDepartment =0;
        $list = Department::where('university_id',$university->university_id)->get();
        $totalDepartment = $totalDepartment + count($list);
        
        $totalCourses=0;
        $list = Subject::where('university_id',$university->university_id)->get();
        $totalCourses = $totalCourses + count($list);

        return view('admin.modify.detailsUniversity',compact('admin','university','totalEmployees','totalStudent','totalDepartment','totalCourses'));
        
    }

    public function viewAdmin(Request $request)
    {
        
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        //Sorting part
        $sortType="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='admin_id' || $sort=='email' || $sort=='phone' || $sort=='created_at')
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
                        $adminList = Admin::paginate(7);
                        return view('admin.modify.admin',compact('admin','adminList','sortType'));
                    }
                } 
                else
                {
                    $sortType = 'asc';
                }
                
                $adminList = Admin::orderBy($sort,$sortType)->paginate(7)->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                
            }
            else
            {
                
                $adminList = Admin::paginate(7);
            }
        }else
        {
            
            $adminList = Admin::paginate(7);
        }
        //End Of Sorting


        return view('admin.modify.viewAdmin',compact('admin','adminList','sortType'));
    }


    public function detailsAdmin(Request $request,$ad_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        $ad = Admin::find($ad_id);

        $totalEmployees = 0;
        $list = Account::where('admin_id',$ad->admin_id)->get();
        $totalEmployees = $totalEmployees + count($list);
        $list = Teacher::where('admin_id',$ad->admin_id)->get();
        $totalEmployees = $totalEmployees + count($list);

        $totalStudent =0;
        $list = Student::where('admin_id',$ad->admin_id)->get();
        $totalStudent = $totalStudent + count($list);
        
        $totalUniversity = 0;
        $list = University::where('admin_id',$ad->admin_id)->get();
        $totalUniversity = $totalUniversity + count($list);

        return view('admin.modify.detailsAdmin',compact('admin','ad','totalEmployees','totalStudent','totalUniversity'));
        
    }

    public function viewAccount(Request $request)
    {
        
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        //Sorting part
        $sortType="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='admin_id' || $sort=='email' || $sort=='phone' || $sort=='updated_at' || $sort=='university_id'|$sort=='status')
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
                        $accountList = Account::paginate(7);
                        return view('admin.modify.viewAccount',compact('admin','accountList','sortType'));
                    }
                } 
                else
                {
                    $sortType = 'asc';
                }
                
                $accountList = Account::orderBy($sort,$sortType)->paginate(7)->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                
            }
            else
            {
                
                $accountList = Account::paginate(7);
            }
        }else
        {
            
            $accountList = Account::paginate(7);
        }
        //End Of Sorting


        return view('admin.modify.viewAccount',compact('admin','accountList','sortType'));
    }
    
    public function editAccount(Request $request, $ad_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();

        $account = account::find($ad_id);
        
        return view('admin.modify.editAccount',compact('admin','account'));
    }

    public function editAccountVerify(Request $request, $ac_id)
    {
        
        $request->validate([
            'name' => 'required|regex:/^[\pL\s.,\-]+$/u|min:4|max:35',
            'salary' => 'required|numeric|min:0|max:100000',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'status' => 'required|in:active,inactive,resigned',
            'profile_pic' => 'mimes:jpg,png|max:5000',
            'birthdate' => 'required|date|before:2005/01/01',
        ]);
        
        $account = Account::find($ac_id);
        
        if(empty($account))
        {
            $request->session()->flash('msg',"Account May No Longer Exist");
        
        }
        else if($account)
        {
            $account->name = $request->name;
            $account->address = $request->address;
            $account->status = $request->status;
            $account->salary= $request->salary;
            $account->birthdate =$request->birthdate;

            if($request->profile_pic)
            {
                $profile_picExtension = $request->file('profile_pic')->extension();
                $destination = 'images/account';
                $fileName = $account->account_id.date('U').".".$profile_picExtension;
                $request->profile_pic->move($destination,$fileName);
                
                if($account->profile_pic)
                {
                    unlink($account->profile_pic);
                }
                $account->profile_pic = $destination."/".$fileName;
            }
            if($account->save()){

                $request->session()->flash('msg',"Account Information Updated");
            }
            else
            {
                $request->session()->flash('msg',"Account Information Update Failed");
                
            }
            
        }

        return Back();
    }
    
    public function detailsAccount(Request $request,$ac_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        $ad = Account::find($ac_id);

        return view('admin.modify.detailsAccount',compact('admin','ad'));
        
    }

    public function viewTeacher(Request $request)
    {
        
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        //Sorting part
        $sortType="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='admin_id' || $sort=='email' || $sort=='phone' || $sort=='updated_at' || $sort=='university_id'|$sort=='status')
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
                        $teacherList = Teacher::paginate(7);
                        return view('admin.modify.viewTeacher',compact('admin','teacherList','sortType'));
                    }
                } 
                else
                {
                    $sortType = 'asc';
                }
                
                $teacherList = Teacher::orderBy($sort,$sortType)->paginate(7)->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                
            }
            else
            {
                
                $teacherList = Teacher::paginate(7);
            }
        }else
        {
            
            $teacherList = Teacher::paginate(7);
        }
        //End Of Sorting


        return view('admin.modify.viewTeacher',compact('admin','teacherList','sortType'));
    }

    public function editTeacher(Request $request, $ad_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();

        $teacher = Teacher::find($ad_id);
        
        return view('admin.modify.editTeacher',compact('admin','teacher'));
    }

    public function editTeacherVerify(Request $request, $t_id)
    {
        
        $request->validate([
            'name' => 'required|regex:/^[\pL\s.,\-]+$/u|min:4|max:35',
            'salary' => 'required|numeric|min:0|max:100000',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'status' => 'required|in:active,inactive,resigned',
            'profile_pic' => 'mimes:jpg,png|max:5000',
            'birthdate' => 'required|date|before:2005/01/01',
        ]);
        
        $teacher = Teacher::find($t_id);
        
        if(empty($teacher))
        {
            $request->session()->flash('msg',"Teacher May No Longer Exist");
        
        }
        else if($teacher)
        {
            $teacher->name = $request->name;
            $teacher->address = $request->address;
            $teacher->status = $request->status;
            $teacher->salary= $request->salary;
            $teacher->birthdate =$request->birthdate;

            if($request->profile_pic)
            {
                $profile_picExtension = $request->file('profile_pic')->extension();
                $destination = 'images/teacher';
                $fileName = $teacher->teacher_id.date('U').".".$profile_picExtension;
                $request->profile_pic->move($destination,$fileName);
                
                if($teacher->profile_pic)
                {
                    unlink($teacher->profile_pic);
                }
                $teacher->profile_pic = $destination."/".$fileName;
            }
            if($teacher->save()){

                $request->session()->flash('msg',"Teacher Information Updated");
            }
            else
            {
                $request->session()->flash('msg',"Teacher Information Update Failed");
                
            }
            
        }

        return Back();
    }

    public function detailsTeacher(Request $request,$t_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        $ad = Teacher::find($t_id);

        return view('admin.modify.detailsTeacher',compact('admin','ad'));
        
    }

    public function viewStudent(Request $request)
    {
        
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        //Sorting part
        $sortType="";
        if($request->has('sort'))
        {
            $sort = $request->get('sort');
            if($sort=='name'|| $sort=='admin_id' || $sort=='email' || $sort=='phone' || $sort=='updated_at' || $sort=='university_id'|$sort=='status')
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
                        $studentList = Student::paginate(7);
                        return view('admin.modify.viewTeacher',compact('admin','studentList','sortType'));
                    }
                } 
                else
                {
                    $sortType = 'asc';
                }
                
                $studentList = Student::orderBy($sort,$sortType)->paginate(7)->appends(['sort'=> $sort, 'sortType'=>$sortType]);
                
            }
            else
            {
                
                $studentList = Student::paginate(7);
            }
        }else
        {
            
            $studentList = Student::paginate(7);
        }
        //End Of Sorting


        return view('admin.modify.viewStudent',compact('admin','studentList','sortType'));
    }

    public function editStudent(Request $request, $s_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                ->first();

        $student = Student::find($s_id);
        
        return view('admin.modify.editStudent',compact('admin','student'));
    }

    public function editStudentVerify(Request $request, $s_id)
    {
        
        $request->validate([
            'name' => 'required|regex:/^[\pL\s.,\-]+$/u|min:4|max:35',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'status' => 'required|in:active,inactive',
            'profile_pic' => 'mimes:jpg,png|max:5000',
            'birthdate' => 'required|date|before:2005/01/01',
            'admission_date' => 'required|date|after:birthdate',
        ]);
        
        $student = Student::find($s_id);
        
        if(empty($student))
        {
            $request->session()->flash('msg',"Student May No Longer Exist");
        
        }
        else if($student)
        {
            $student->name = $request->name;
            $student->address = $request->address;
            $student->status = $request->status;
            $student->birthdate =$request->birthdate;
            $student->admission_date =$request->admission_date;
            if($request->profile_pic)
            {
                $profile_picExtension = $request->file('profile_pic')->extension();
                $destination = 'images/student';
                $fileName = $student->student_id.date('U').".".$profile_picExtension;
                $request->profile_pic->move($destination,$fileName);
                
                if($student->profile_pic)
                {
                    unlink($student->profile_pic);
                }
                $student->profile_pic = $destination."/".$fileName;
            }
            if($student->save()){

                $request->session()->flash('msg',"Student Information Updated");
            }
            else
            {
                $request->session()->flash('msg',"Student Information Update Failed");
                
            }
            
        }

        return Back();
    }

    public function detailsStudent(Request $request,$s_id)
    {
        $admin = Admin::where('username',$request->session()->get('username'))
                    ->first();
        $ad = Student::find($s_id);

        return view('admin.modify.detailsStudent',compact('admin','ad'));
        
    }












    //-----------------------------------optional
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
    //----------------------------------------------

}
