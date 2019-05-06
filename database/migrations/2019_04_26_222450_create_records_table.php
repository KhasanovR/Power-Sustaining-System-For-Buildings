<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->double('economed_energy');
            $table->double('year_of_return');
            $table->double('left_money');
            $table->double('pts');
            $table->timestamps();
        });

        Schema::table('records', function($table) {
            DB::statement('ALTER Table records add id BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT FIRST;');
            $table->primary(['id','user_id']);
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
        Schema::dropIfExists('records');
    }
}
