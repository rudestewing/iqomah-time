<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('date');
            $table->json('data')->nullable();
            $table->unsignedBigInteger('time_id');
            $table->time('time')->nullable();
            $table->bigInteger('epoch');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('time_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
