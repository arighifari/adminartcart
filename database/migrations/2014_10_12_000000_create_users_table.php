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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->integer('balance')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('avatar')->default('avatar/default.png');
            $table->string('bio')->nullable();
            $table->unsignedInteger('address')->nullable();
            $table->foreign('address')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('home_address')->nullable();
            $table->boolean('admin')->default(0);
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
        Schema::dropIfExists('users');
    }
}
