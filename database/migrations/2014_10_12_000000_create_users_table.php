<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('RoleID')->nullable();
            $table->integer('phone_no')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->integer('pin_code')->nullable();
            $table->integer('sold_consumed')->nullable();
            $table->integer('sold')->nullable();
            $table->integer('sold_total')->nullable();
            $table->string('job_title')->nullable();
            $table->string('address')->nullable();
            $table->integer('time_zone_id')->nullable();
            $table->string('organization')->nullable();
            $table->string('Is_Sendmail_Password')->nullable();
            $table->string('description')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('Is_Active')->nullable();
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
        Schema::dropIfExists('users');
    }
}
