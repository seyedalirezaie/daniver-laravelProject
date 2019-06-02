<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedInteger('subcity_id');
            $table->foreign('subcity_id')->references('id')->on('subcities');

            $table->string('type');
            $table->string('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
