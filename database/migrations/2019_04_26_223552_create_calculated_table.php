<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->bigInteger('rec_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->bigInteger('building_season')->unsigned();
            $table->bigInteger('ecg_items_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('calculated', function($table) {
            $table->primary(['rec_id','user_id','building_season','ecg_items_id']);

            $table->foreign(['rec_id','user_id'])->references(['id','user_id'])->on('records')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign(['user_id','ecg_items_id', 'building_season'])->references(['user_id','building_season','ecg_items_id'])->on('select')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign([/*'user_id',*/'ecg_items_id', 'building_season'])->references([/*'user_id',*/'ecg_items_id', 'building_season'])->on('posses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculated');
    }
}
