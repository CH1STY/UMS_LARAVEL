<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('assignment_id',10)->unique();
            $table->mediumText('details');
            $table->string('admin_id',10);
            $table->foreign('admin_id')->references('admin_id')->on('admins');
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
        Schema::dropIfExists('assignments');
    }
}
