<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateSelectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('ecg_items_id')->unsigned();
            $table->bigInteger('building_season')->unsigned();
            $table->bigInteger('is_sold')->unsigned();
            $table->timestamps();
        });
        Schema::table('select', function($table) {
            $table->primary(['user_id','building_season','ecg_items_id', 'is_sold']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ecg_items_id')->references('id')->on('ecg_items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('building_season')->references('season')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('select');
    }
}
