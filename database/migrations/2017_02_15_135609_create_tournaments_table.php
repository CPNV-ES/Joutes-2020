<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) { 
 
            $table->increments('id'); 
            $table->string('name', 45); 
            $table->dateTime('start_date'); 
            $table->string('img',45)->nullable(); 
            $table->integer('event_id')->unsigned();
            $table->integer('sport_id')->unsigned(); 
 
            $table->foreign('event_id')->references('id')->on('events'); 
            $table->foreign('sport_id')->references('id')->on('sports'); 
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('tournaments'); 
    }
}
