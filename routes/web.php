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


    //--------------------------------------------END OF ADMIN PART
    
    //------Start of Teacher Part

    Route::get('teacher','TeacherController@index')->name('teacher');


    //--------------------------------------------END OF TEACHER PART

    //------Start of Accounts Part

    Route::get('account','AccountController@index')->name('account');
    
    //--------------------------------------------End Of Accounts Part
    
    //------Start of Student Part

    Route::get('student','StudentController@index')->name('student'); 

    //--------------------------------------------End Of Student Part

});


