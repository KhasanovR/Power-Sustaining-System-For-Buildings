<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->bigIncrements('season');
            $table->double('money_pack');
            $table->double('price_kw');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('buildings', function($table) {
            // $table->primary(['season']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
