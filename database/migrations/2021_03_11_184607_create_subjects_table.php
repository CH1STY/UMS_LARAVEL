<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject_code',10)->unique();
            $table->string('name',50);
            $table->string('admin_id',10);
            $table->foreign('admin_id')->references('admin_id')->on('admins');
            $table->string('university_id',10);
            $table->foreign('university_id')->references('university_id')->on('universities');
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
        Schema::dropIfExists('subjects');
    }
}
