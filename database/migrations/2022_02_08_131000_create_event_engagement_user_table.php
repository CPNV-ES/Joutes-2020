<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventEngagementUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_engagement_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();;
            $table->integer('engagement_id')->unsigned();;

            $table->foreign(['user_id'])
                ->references(['id'])
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign(['event_id'])
                ->references(['id'])
                ->on('events')
                ->onDelete('CASCADE');
            $table->foreign(['engagement_id'])
                ->references(['id'])
                ->on('engagements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_engagement_user');
    }
}
