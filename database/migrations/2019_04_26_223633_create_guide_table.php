<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->bigInteger('guider_id')->unsigned();
            $table->bigInteger('guidee_id')->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->bigInteger('building_season')->unsigned();
            // $table->bigInteger('building_id')->unsigned();
            $table->bigInteger('ecg_items_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('guide', function($table) {
            $table->primary(['guider_id','guidee_id','level_id','building_season','ecg_items_id'], 'gglbe');

            $table->foreign('guider_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('guidee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('building_season')->references('season')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ecg_items_id')->references('id')->on('ecg_items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide');
    }
}
