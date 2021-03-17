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

Route::middleware(['sessionVerify'])->group(function () {
    //------Start of Admin Part
    Route::get('admin','AdminController@index')->name('admin');

    Route::get('create/admin','AdminController@createAdmin')->name('create.admin');
    Route::post('create/admin','AdminController@createAdminVerify');

    Route::get('create/account','AdminController@createAccount')->name('create.account');
    Route::post('create/account','AdminController@createAccountVerify')->name('create.account');

    Route::get('create/teacher','AdminController@createTeacher')->name('create.teacher');
    Route::post('create/teacher','AdminController@createTeacherVerify');

    Route::get('create/student','AdminController@createStudent')->name('create.student');
    Route::post('create/student','AdminController@createStudentVerify');

    Route::get('admin/view/universityList','AdminModifyController@viewUniversity')->name('admin.view.university');
    Route::get('admin/edit/university/{univ_id}','AdminModifyController@editUniversity')->name('admin.edit.university');
    Route::post('admin/edit/university/{univ_id}','AdminModifyController@editUniversityVerify');

    //--------------------------------------------END OF ADMIN PART

    //------Start of Teacher Part

    Route::get('teacher','TeacherController@index')->name('teacher');
    Route::get('teacher/profile','TeacherController@profile')->name('teacher.profile');
    Route::post('teacher/profile','TeacherController@profilePicUP');
    Route::get('teacher/profile/edit','TeacherController@edit')->name('teacher.edit');
    Route::post('teacher/profile/edit','TeacherController@profileUpdate');
    Route::get('teacher/student','TeacherController@viewStudent')->name('teacher.viewStudent');

    Route::get('teacher/course','CourseController@teacherCourselist')->name('teacher.viewCourselist');
    Route::get('teacher/mycourse','CourseController@teacherCourse')->name('teacher.viewMyCourselist');
    Route::post('teacher/course/details/{course_id}','CourseController@courseDetails')->name('teacher.courseDetails');



    //--------------------------------------------END OF TEACHER PART

    //------Start of Accounts Part

    Route::get('account','AccountController@index')->name('account');

    //--------------------------------------------End Of Accounts Part

    //------Start of Student Part

    Route::get('student','StudentController@index')->name('student');

    //--------------------------------------------End Of Student Part

});


