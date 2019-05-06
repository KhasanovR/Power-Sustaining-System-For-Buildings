<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level_no')->default(0);
            $table->integer('guide_bonus')->default(0);
            $table->bigInteger('rank_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('levels', function($table) {
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
