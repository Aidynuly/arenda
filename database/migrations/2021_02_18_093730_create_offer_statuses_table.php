<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('house_id');
            $table->string('price');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['accepted', 'declined', 'done', 'deleted']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('house_id')->references('id')->on('houses');
            $table->foreign('offer_id')->references('id')->on('offers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_statuses');
    }
}
