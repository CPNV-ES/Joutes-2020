<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pools', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('poolName', 45);
            $table->integer('stage');
            $table->integer('poolSize');
            $table->integer('poolState');

            $table->integer('tournament_id')->unsigned();
            $table->integer('mode_id')->unsigned();
            $table->integer('game_type_id')->unsigned();

            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->foreign('mode_id')->references('id')->on('pool_modes');
            $table->foreign('game_type_id')->references('id')->on('game_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pools');
    }
}
