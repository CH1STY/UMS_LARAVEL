<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_course_id',10)->unique();
            $table->float('marks',3,2);
            $table->string('status',15);
            $table->string('student_id',10);
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->string('course_id',10);
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
