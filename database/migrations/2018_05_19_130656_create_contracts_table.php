<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contractable_id');
            $table->string('contractable_type');
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('octane_cost')->nullable();
            $table->integer('diesel_cost')->nullable();
            $table->integer('cng_cost')->nullable();
            $table->integer('car_rent');
            $table->integer('num_of_car')->default(1);
            $table->integer('starting_octane');
            $table->integer('overtime_cost');
            $table->integer('breakfast_cost');
            $table->integer('launch_cost');
            $table->integer('dinner_cost');
            $table->string('contract_type');
            $table->integer('contract_duration');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
