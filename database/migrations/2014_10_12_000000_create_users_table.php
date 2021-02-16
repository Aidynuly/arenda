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
            $table->string('token')->unique();
            $table->string('name');
            $table->string('surname');
            $table->unsignedInteger('city_id');
            $table->enum('type', ['user', 'seller']);
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
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
