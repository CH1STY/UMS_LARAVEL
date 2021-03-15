<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teacher_course_id',10)->unique();
            $table->string('teacher_id',10);
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers');
            $table->string('course_id',10);
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->string('status',15);
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
        Schema::dropIfExists('teacher_courses');
    }
}
