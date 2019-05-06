<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('rank_no');
            $table->bigInteger('rec_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('ranks', function($table) {
            // DB::statement('ALTER Table ranks add id BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT FIRST rank_no;');
            // $table->primary(['id','user_id']);
            $table->foreign(['user_id','rec_id'])->references(['user_id','rec_id'])->on('best_records')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranks');
    }
}
