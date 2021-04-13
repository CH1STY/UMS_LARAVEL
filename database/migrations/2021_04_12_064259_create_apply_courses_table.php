<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('apply_course_id',10)->unique();
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->string('course1_id',10);
            $table->foreign('course1_id')->references('course_id')->on('courses');
            $table->string('course2_id',10);
            $table->foreign('course2_id')->references('course_id')->on('courses');
            $table->string('course3_id',10);
            $table->foreign('course3_id')->references('course_id')->on('courses');
            $table->string('course4_id',10);
            $table->foreign('course4_id')->references('course_id')->on('courses');
            $table->string('status',15);
            $table->string('student_id',10);
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
        Schema::dropIfExists('apply_courses');
    }
}
