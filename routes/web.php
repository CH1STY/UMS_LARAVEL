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

    });    



    //--------------------------------------------END OF ADMIN PART

    //------Start of Teacher Part

    Route::get('teacher','TeacherController@index')->name('teacher');

    Route::middleware(['teachercheck'])->group(function () {

        //Profile
        Route::get('teacher/profile','TeacherController@profile')->name('teacher.profile');
        Route::get('teacher/profile/edit','TeacherController@edit')->name('teacher.edit');
        Route::post('teacher/profile/edit','TeacherController@profileUpdate');

        //Teacher Student
        Route::get('teacher/student','TeacherStudentController@viewStudent')->name('teacher.viewStudent');
        Route::get('teacher/{id}/studentlist','TeacherStudentController@studentlist')->name('teacher.studentlist');
        Route::get('teacher/studentdetails/{id}','TeacherStudentController@studentdetails')->name('teacher.studentdetails');
        Route::get('teacher/student/drop/{id}','TeacherStudentController@studentdrop')->name('teacher.studentdrop');

        //Teacher Course
        Route::get('teacher/course','CourseController@teacherCourselist')->name('teacher.viewCourselist');

        //Search Course
        Route::get('/home/searchCourse', 'CourseController@searchCourse')->name('teacher.searchCourse');
        Route::get('/home/action', 'CourseController@action')->name('teacher.action');

        Route::get('teacher/mycourse','CourseController@teacherCourse')->name('teacher.viewMyCourselist');

        Route::get('teacher/course/details/{course_id}','CourseController@courseDetails')->name('teacher.courseDetails');

        //Teacher Note
        Route::get('teacher/notes','CourseController@noteCourse')->name('teacher.noteCourse');
        Route::get('teacher/notes/upload/{id}','CourseController@noteUpload')->name('teacher.noteUpload');

        //Teacher Accounts
        Route::get('teacher/viewAccount','TeacherAccountController@viewAccount')->name('teacher.viewAccount');

    });

    //--------------------------------------------END OF TEACHER PART

    //------Start of Accounts Part

    Route::get('account','AccountController@index')->name('account');

    //--------------------------------------------End Of Accounts Part

    //------Start of Student Part

    Route::get('student','StudentController@index')->name('student');

    //--------------------------------------------End Of Student Part

});


