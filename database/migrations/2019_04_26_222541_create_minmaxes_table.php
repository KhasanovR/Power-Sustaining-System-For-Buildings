<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinmaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minmaxes', function (Blueprint $table) {
            $table->string('item_type');
            $table->integer('min');
            $table->integer('max');
            // $table->bigIncrements('id');
            $table->timestamps();
        });
        Schema::table('minmaxes', function (Blueprint $table) {
            $table->primary('item_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minmaxes');
    }
}
