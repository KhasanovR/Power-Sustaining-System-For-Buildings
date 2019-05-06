<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcgItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecg_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
           $table->string('model'); 
            $table->double('price');
            $table->double('energy_cg');
            $table->string('item_type');
            $table->string('energy_type');
            $table->string('image');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('ecg_items', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_type')->references('item_type')->on('minmaxes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecg_items');
    }
}
