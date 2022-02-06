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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('mobile_number');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer('fresher')->nullable();
            $table->double('experience')->nullable();
            $table->double('salary')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('institute')->nullable();
            $table->double('cgpa')->nullable();
            $table->unsignedBigInteger('setting_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('setting_id')->references('id')->on('settings');
            $table->foreign('category_id')->references('id')->on('categories');
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
