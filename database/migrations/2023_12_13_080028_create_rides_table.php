<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id('ride_id');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('driver_id')->on('drivers')->onDelete('cascade');
            $table->enum('ride_status', ['0', '1', '2'])->default('0'); // 0 = standby, 1 = ongoing, 2 = finished
            $table->string('start_location');
            $table->string('destination_location');
            $table->double('start_lat');
            $table->double('start_lng');
            $table->double('destination_lat');
            $table->double('destination_lng');
            $table->string('going_date');
            $table->string('going_time');
            $table->string('car_model');
            $table->string('car_capacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
