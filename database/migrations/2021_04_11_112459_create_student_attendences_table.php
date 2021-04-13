<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_attendence_id',10)->unique();
            $table->smallInteger('attendence');
            $table->string('status',15);
            $table->string('student_id',10);
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->string('course_id',10);
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->string('teacher_id',10);
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers');
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
        Schema::dropIfExists('student_attendences');
    }
}
