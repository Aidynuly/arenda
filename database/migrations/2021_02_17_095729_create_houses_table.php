<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('description');
            $table->integer('rooms');
            $table->float('area');
            $table->unsignedBigInteger('region_id');
            $table->string('address');
            $table->boolean('is_active')->default(true);
            $table->addColumn('string', 'lat')->nullable();
            $table->addColumn('string', 'long')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
