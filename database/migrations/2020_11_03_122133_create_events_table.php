<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organizer_id')->unsigned();
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('cascade');
            $table->string('event_code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('location');
            $table->string('time_from');
            $table->string('time_until');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
