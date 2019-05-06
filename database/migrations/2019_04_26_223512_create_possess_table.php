<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posses', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->unsignedBigInteger('building_season');
            $table->bigInteger('ecg_items_id')->unsigned();
            $table->bigInteger('quantity')->unsigned();
            $table->timestamps();
        });
        Schema::table('posses', function($table) {
            $table->primary(['building_season', 'ecg_items_id']);
            $table->foreign('building_season')->references('season')->on('buildings');
            $table->foreign('ecg_items_id')->references('id')->on('ecg_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posses');
    }
}
