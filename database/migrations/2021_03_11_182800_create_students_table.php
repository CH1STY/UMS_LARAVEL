<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id',10)->unique();
            $table->string('password',200);
            $table->string('email',50)->unique();
            $table->string('phone',15)->unique();
            $table->mediumText('address');
            $table->string('username',20)->unique();
            $table->string('name',50);
            $table->integer('balance');
            $table->string('status',15);
            $table->date('birthdate');
            $table->date('admission_date');
            $table->smallInteger('credits_completed')->default(0);
            $table->float('CGPA',2,2)->default(0.0);
            $table->string('admin_id',10);
            $table->foreign('admin_id')->references('admin_id')->on('admins');
            $table->string('university_id',10);
            $table->foreign('university_id')->references('university_id')->on('universities');
            $table->string('department_id',10);
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->string('profile_pic',100)->nullable();
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
        Schema::dropIfExists('students');
    }
}
