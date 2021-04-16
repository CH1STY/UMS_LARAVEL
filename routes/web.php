<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@verify');

Route::get('logout', 'LogoutController@logout')->name('logout');

Route::get('check','Check@index');

Route::get('/registration','RegistrationController@index')->name('registration');
Route::post('/registration','RegistrationController@registrationVerify');

Route::middleware(['sessionVerify'])->group(function () {
    //------Start of Admin Part

    Route::middleware(['adminVerify'])->group(function () {

        Route::get('admin','AdminController@index')->name('admin');

        Route::get('admin/profile','AdminController@profile')->name('admin.profile');
        Route::post('admin/profile','AdminController@profileVerify');

        Route::get('create/admin','AdminController@createAdmin')->name('create.admin');
        Route::post('create/admin','AdminController@createAdminVerify');

        Route::get('create/account','AdminController@createAccount')->name('create.account');
        Route::post('create/account','AdminController@createAccountVerify')->name('create.account');

        Route::get('create/teacher','AdminController@createTeacher')->name('create.teacher');
        Route::post('create/teacher','AdminController@createTeacherVerify');

        Route::get('create/student','AdminController@createStudent')->name('create.student');
        Route::post('create/student','AdminController@createStudentVerify');

        Route::get('admin/view/universityList','AdminModifyController@viewUniversity')->name('admin.view.university');
        Route::get('admin/fetch/universityList','AdminModifyController@fetchUniversity')->name('admin.fetch.university');
        Route::get('admin/edit/university/{univ_id}','AdminModifyController@editUniversity')->name('admin.edit.university');
        Route::get('admin/details/university/{univ_id}','AdminModifyController@detailsUniversity')->name('admin.details.university');
        Route::post('admin/edit/university/{univ_id}','AdminModifyController@editUniversityVerify');

        Route::get('admin/view/adminList','AdminModifyController@viewAdmin')->name('admin.view.admin');
        Route::get('admin/fetch/adminList','AdminModifyController@fetchAdmin')->name('admin.fetch.admin');
        Route::get('admin/details/admin/{ad_id}','AdminModifyController@detailsAdmin')->name('admin.details.admin');

        Route::get('admin/view/accountList','AdminModifyController@viewAccount')->name('admin.view.account');
        Route::get('admin/fetch/accountList','AdminModifyController@fetchAccount')->name('admin.fetch.account');
        Route::get('admin/edit/account/{ac_id}','AdminModifyController@editAccount')->name('admin.edit.account');
        Route::post('admin/edit/account/{ac_id}','AdminModifyController@editAccountVerify');
        Route::get('admin/details/account/{ac_id}','AdminModifyController@detailsAccount')->name('admin.details.account');

        Route::get('admin/view/teacherList','AdminModifyController@viewTeacher')->name('admin.view.teacher');
        Route::get('admin/fetch/teacherList','AdminModifyController@fetchTeacher')->name('admin.fetch.teacher');
        Route::get('admin/edit/teacher/{t_id}','AdminModifyController@editTeacher')->name('admin.edit.teacher');
        Route::post('admin/edit/teacher/{t_id}','AdminModifyController@editTeacherVerify');
        Route::get('admin/details/teacher/{t_id}','AdminModifyController@detailsTeacher')->name('admin.details.teacher');

        Route::get('admin/view/studentList','AdminModifyController@viewStudent')->name('admin.view.student');
        Route::get('admin/fetch/studentList','AdminModifyController@fetchStudent')->name('admin.fetch.student');
        Route::get('admin/edit/student/{s_id}','AdminModifyController@editStudent')->name('admin.edit.student');
        Route::post('admin/edit/student/{s_id}','AdminModifyController@editStudentVerify');
        Route::get('admin/details/student/{s_id}','AdminModifyController@detailsStudent')->name('admin.details.student');

        Route::get('admin/notice/add','AdminNoticeController@addNotice')->name('admin.notice.add');
        Route::post('admin/notice/add','AdminNoticeController@addNoticeVerify');
        Route::get('admin/notice/viewList','AdminNoticeController@viewNotices')->name('admin.notice.view');
        Route::get('admin/notice/fetch','AdminNoticeController@fetchNotices')->name('admin.notice.fetch');
        Route::get('admin/notice/delete/{notice_id}','AdminNoticeController@delete')->name('admin.notice.delete');

        Route::get('admin/subject/add','AdminCourseController@addSubject')->name('admin.subject.add');
        Route::post('admin/subject/add','AdminCourseController@addSubjectVerify');

        Route::get('admin/course/add','AdminCourseController@addCourse')->name('admin.course.add');
        Route::post('admin/course/add','AdminCourseController@addCourseVerify');
        Route::get('admin/course/view','AdminCourseController@viewCourses')->name('admin.course.view');
        Route::get('admin/course/fetch','AdminCourseController@fetchCourses')->name('admin.course.fetch');
        Route::get('admin/course/edit/{id}','AdminCourseController@editCourse')->name('admin.course.edit');
        Route::post('admin/course/edit/{id}','AdminCourseController@updateCourse')->name('admin.course.edit');

        Route::get('admin/subject/view','AdminCourseController@viewSubjects')->name('admin.subject.view');
        Route::get('admin/subject/fetch','AdminCourseController@fetchSubjects')->name('admin.subject.fetch');
        Route::get('admin/subject/edit/{id}','AdminCourseController@editSubject')->name('admin.subject.edit');
        Route::post('admin/subject/edit/{id}','AdminCourseController@updateSubject')->name('admin.subject.edit');

        Route::get('admin/registrationControl','AdminRegistrationController@index')->name('admin.registration');
        Route::get('admin/registrationControl/update','AdminRegistrationController@update')->name('admin.registration.update');

        Route::get('admin/Student_Course_Control/Add','AdminStudentCourseController@addView')->name('admin.student.course.add');
        Route::post('admin/Student_Course_Control/Add','AdminStudentCourseController@addCourseVerify')->name('admin.student.course.add');
        Route::get('admin/Student_Course_Control/Fetch','AdminStudentCourseController@addViewFetch')->name('admin.student.course.fetch');
        Route::get('admin/Student_Course_Control/Remove','AdminStudentCourseController@removeView')->name('admin.student.course.remove');
        Route::post('admin/Student_Course_Control/Remove','AdminStudentCourseController@removeVerify')->name('admin.student.course.remove');
        Route::get('admin/Student_Course_Control/FetchDrop','AdminStudentCourseController@dropViewFetch')->name('admin.student.course.fetch.drop');

        Route::get('admin/ResignManagement','AdminResignController@index')->name('admin.resign');
        Route::get('admin/ResignManagement/fetch','AdminResignController@fetch')->name('admin.resign.fetch');
        Route::get('admin/Resign/accept/{empid}','AdminResignController@accept')->name('admin.resign.accept');
        Route::get('admin/Resign/reject/{empid}','AdminResignController@reject')->name('admin.resign.reject');

        Route::get('admin/genReport/University','AdminReportGen@universityView')->name('admin.report.university');
        Route::post('admin/genReport/University','AdminReportGen@downloadUnivReport')->name('admin.report.university');


    });



    //--------------------------------------------END OF ADMIN PART

    //------Start of Teacher Part

    Route::get('teacher','TeacherController@index')->name('teacher');

    Route::middleware(['teachercheck'])->group(function () {

        //Profile
        Route::get('teacher/profile','TeacherController@profile')->name('teacher.profile');
        Route::get('teacher/profile/edit','TeacherController@edit')->name('teacher.edit');
        Route::post('teacher/profile/edit','TeacherController@profileUpdate');

        //Resign Request
        Route::get('teacher/resignRequest','TeacherController@resignRequest')->name('teacher.resignRequest');
        Route::get('teacher/resigning','TeacherController@resigning')->name('teacher.resigning');
        Route::get('teacher/deleteResigning','TeacherController@deleteresigning')->name('teacher.deleteResigning');

        //Teacher Student
        Route::get('teacher/student','TeacherStudentController@viewStudent')->name('teacher.viewStudent');
        Route::get('teacher/student/addcourse','TeacherStudentController@addstudentcourse')->name('teacher.addstudentcourse');
        Route::get('teacher/student/{id}/addtocourse','TeacherStudentController@addedstudentcourse')->name('teacher.addedstudentcourse');
        Route::get('teacher/{id}/studentlist','TeacherStudentController@studentlist')->name('teacher.studentlist');
        Route::get('teacher/studentdetails/{id}','TeacherStudentController@studentdetails')->name('teacher.studentdetails');
        Route::get('teacher/student/drop/{id}','TeacherStudentController@studentdrop')->name('teacher.studentdrop');

        //Teacher Course
        Route::get('teacher/course','CourseController@teacherCourselist')->name('teacher.viewCourselist');

        //Search Course
        Route::get('teacher/searchCourse', 'CourseController@searchCourse')->name('teacher.searchCourse');
        Route::get('teacher/action', 'CourseController@action')->name('teacher.action');

        Route::get('teacher/mycourse','CourseController@teacherCourse')->name('teacher.viewMyCourselist');
        Route::get('teacher/course/details/{course_id}','CourseController@courseDetails')->name('teacher.courseDetails');

        //Teacher Note
        Route::get('teacher/notes','CourseController@noteCourse')->name('teacher.noteCourse');
        Route::get('teacher/notes/upload/{id}','CourseController@noteUpload')->name('teacher.noteUpload');
        Route::post('teacher/notes/upload/{id}','CourseController@noteUploadPost')->name('teacher.noteUpload.post');
        Route::get('teacher/notes/download/{id}','CourseController@notedownload')->name('teacher.notedownload');
        Route::get('teacher/notes/delete/{id}','CourseController@notedelete')->name('teacher.notedelete');

        //Teacher Assignment
        Route::get('teacher/assignment','CourseController@assignmentCourse')->name('teacher.assignmentCourse');
        Route::get('teacher/assignment/upload/{id}','CourseController@assignmentUpload')->name('teacher.assignmentUpload');
        Route::post('teacher/assignment/upload/{id}','CourseController@assignmentUploadPost')->name('teacher.assignmentUpload.post');
        Route::get('teacher/assignment/download/{id}','CourseController@assignmentdownload')->name('teacher.assignmentdownload');
        Route::get('teacher/assignment/collect/{id}','CourseController@assignmentcollect')->name('teacher.assignmentcollect');
        Route::get('teacher/assignment/delete/{id}','CourseController@assignmentdelete')->name('teacher.assignmentdelete');


        //Drop request
        Route::get('teacher/student/dropRequest','CourseController@dropRequest')->name('teacher.dropRequest');
        Route::get('teacher/student/dropping/{cid}/{sid}','CourseController@dropping')->name('teacher.dropping');
        Route::get('teacher/student/droppingCancel/{cid}/{sid}','CourseController@droppingCancel')->name('teacher.droppingCancel');

        //Teacher Accounts
        Route::get('teacher/viewAccount','TeacherAccountController@viewAccount')->name('teacher.viewAccount');

        //Teacher Notice
        Route::get('teacher/notice/admin','TeacherNoticeController@noticeadmin')->name('teacher.noticeadmin');
        Route::get('teacher/notice','TeacherNoticeController@noticeTeacher')->name('teacher.noticeTeacher');
        Route::get('teacher/notice/course','TeacherNoticeController@noticeCourse')->name('teacher.noticeCourse');
        Route::get('teacher/notice/upload/{id}','TeacherNoticeController@noticeUpload')->name('teacher.noticeUpload');
        Route::post('teacher/notice/upload/{id}','TeacherNoticeController@uploadNotice')->name('teacher.uploadNotice');

        Route::get('teacher/notice/delete/{id}','TeacherNoticeController@noticedelete')->name('teacher.noticedelete');
        //Export
        Route::get('teacher/DownloadStudentReport', 'TeacherStudentController@StudentReport')->name('teacher.studentReport');

        //Student Attendence Export Import
        Route::get('teacher/attendence', 'TeacherStudentController@attendence')->name('teacher.attendence');
        Route::post('teacher/attendence', 'TeacherStudentController@importAttendence')->name('teacher.attendence.post');
        Route::get('teacher/StudentAttendence', 'TeacherStudentController@StudentAttendence')->name('teacher.studentAttendence');

        //Print pdf
        Route::get('teacher/Account/Print/{id}','TeacherAccountController@accountPrint')->name('teacher.accountPrint');

    });

    //--------------------------------------------END OF TEACHER PART

    //------Start of Accounts Part

    Route::get('account','AccountController@index')->name('account');

    //--------------------------------------------End Of Accounts Part

    //------Start of Student Part
    Route::middleware(['studentVerify'])->group(function () {
        
        Route::get('student','StudentController@index')->name('student');

        Route::get('student/profile','StudentController@profile')->name('student.profile');
        Route::get('student/profile/edit','StudentController@edit')->name('student.edit');
        Route::post('student/profile/edit','StudentController@profileUpdate');

        Route::get('student/view/courseList','StudentViewController@viewCourse')->name('student.view.viewCourse');
        Route::get('student/view/courseGradeList','StudentViewController@viewCourseGrade')->name('student.view.viewCourseGrade');
        Route::get('student/view/courseCompleteList','StudentViewController@viewCompletedCourse')->name('student.view.viewCompletedCourse');
        Route::get('student/view/courseDropedList','StudentViewController@viewDropedCourse')->name('student.view.viewDropedCourse');

        Route::get('apply/course','StudentController@applyCourse')->name('apply.course');
        Route::post('apply/course','StudentController@applyCourseVerify');

    });

    //--------------------------------------------End Of Student Part

});


