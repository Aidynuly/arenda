<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableOfferStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('house_id')->nullable()->change();
            $table->string('price')->nullable()->change();
        });

        Schema::table('houses', function (Blueprint $table) {
            $table->string('area')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
