<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned()->index();
            $table->integer('company_id')->unsigned()->index()->nullable();
            $table->integer('brand_id')->unsigned()->index();
            $table->integer('photo_id')->nullable()->default(1);
            $table->string('registration_num')->unique();
            $table->string('model_no');
            $table->string('parking_mode');
            $table->date('tax_token_expiry_date');
            $table->date('fitness_expiry_date');
            $table->date('insurance_expiry_date');
            $table->date('road_permit_expiry_date');
            $table->string('driver_name');
            $table->integer('driver_duty');
            $table->string('driver_nid')->unique()->nullable();
            $table->string('driver_address')->nullable();
            $table->string('driver_phone_num');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
