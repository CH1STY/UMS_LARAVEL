<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_id',10)->unique();
            $table->string('name',50);
            $table->string('admin_id',10);
            $table->string('semester',20);
            $table->smallInteger('credits');
            $table->string('subject_code',10);
            $table->foreign('subject_code')->references('subject_code')->on('subjects');
            $table->string('prerequisite',10);
            $table->foreign('prerequisite')->references('subject_code')->on('subjects');
            $table->foreign('admin_id')->references('admin_id')->on('admins');
            $table->string('department_id',10);
            $table->foreign('department_id')->references('department_id')->on('departments');
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
        Schema::dropIfExists('courses');
    }
}
