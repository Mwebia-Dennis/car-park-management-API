<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarParkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_park', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('park_name', 500);
            $table->string('location_name', 500);
            $table->string('park_type_id', 500);
            $table->string('park_type_desc', 1000);
            $table->integer('capacity_of_park');
            $table->string('working_time', 1000);
            $table->string('county_name', 1000);
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->unsignedBigInteger('user_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_park');
    }
}
