<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_info', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->string('date');
            $table->string('brand');
            $table->string('number');
            $table->string('fuel_type');
            $table->string('driver');
            $table->float('fuel_rate_summer', 10, 2);
            $table->float('fuel_rate_winter', 10, 2);
            $table->string('distance');
            $table->string('counted_distance');
            $table->string('distance_remainder');
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
        Schema::dropIfExists('route_info');
    }
}
