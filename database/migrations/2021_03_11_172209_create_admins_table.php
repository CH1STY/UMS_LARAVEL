<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_id',10)->unique();
            $table->string('password',200);
            $table->string('email',50)->unique();
            $table->string('phone',15)->unique();
            $table->mediumText('address');
            $table->string('username',20)->unique();
            $table->string('name',50);
            $table->string('status',15);
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
        Schema::dropIfExists('admins');
    }
}
