<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unsigned()->index();
            $table->date('log_date');
            $table->integer('octane_starting_km')->nullable();
            $table->integer('octane_ending_km')->nullable();
            $table->integer('diesel_starting_km')->nullable();
            $table->integer('diesel_ending_km')->nullable();
            $table->integer('cng_starting_km')->nullable();
            $table->integer('cng_ending_km')->nullable();
            $table->time('starting_time');
            $table->time('ending_time')->nullable();
            $table->integer('payment_amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_reason')->nullable();
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logbooks');
    }
}
