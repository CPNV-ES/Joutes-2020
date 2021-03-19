<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('score_contender1')->nullable();
            $table->integer('score_contender2')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->integer('contender1_id')->unsigned()->nullable();
            $table->integer('contender2_id')->unsigned()->nullable();
            $table->integer('court_id')->unsigned();

            $table->foreign('contender1_id')->references('id')->on('contenders')->onDelete('cascade');;
            $table->foreign('contender2_id')->references('id')->on('contenders')->onDelete('cascade');;
            $table->foreign('court_id')->references('id')->on('courts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('games');
    }
}
