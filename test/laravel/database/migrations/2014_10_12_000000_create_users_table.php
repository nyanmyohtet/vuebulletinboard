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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->string('profile', 255)->nullable();;
            $table->string('type', 1)->default(1);
            $table->string('phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->date('dob')->nullable();
            $table->integer('create_user_id')->unsigned()->nullable();
            $table->foreign('create_user_id')->references('id')->on('users');
            $table->integer('updated_user_id')->unsigned()->nullable();
            $table->foreign('updated_user_id')->references('id')->on('users');
            $table->integer('deleted_user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->rememberToken('');
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
