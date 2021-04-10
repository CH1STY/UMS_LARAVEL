<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teacher_notice_id',10)->unique();
            $table->mediumText('details');
            $table->string('teacher_course_id',10);
            $table->foreign('teacher_course_id')->references('teacher_course_id')->on('teacher_courses');
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
        Schema::dropIfExists('teacher_notices');
    }
}
