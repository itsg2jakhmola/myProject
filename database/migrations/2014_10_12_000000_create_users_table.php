<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('user_type');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('dob');
            $table->string('medical_number');
            $table->string('address');
            $table->integer('phone_number');
            $table->string('doctor_practice');
            $table->string('fax_number');
            $table->string('insurance_company');
            $table->string('insurance_number');
            $table->string('lat');
            $table->string('lng');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
