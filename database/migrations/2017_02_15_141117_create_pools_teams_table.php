<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolsTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rank_in_pool')->nullable();
            $table->integer('pool_id')->unsigned();
            $table->integer('team_id')->unsigned()->nullable();
            $table->integer('pool_from_id')->unsigned()->nullable();
            $table->integer('pool_from_rank')->unsigned()->nullable();

            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('pool_from_id')->references('id')->on('pools')->onDelete('cascade');;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenders');
    }
}
