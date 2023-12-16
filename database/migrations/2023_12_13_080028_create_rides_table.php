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
            $table->enum('status', ['0', '1', '2']);
            $table->string('start_location');
            $table->string('destination_location');
            $table->string('car_model');
            $table->string('car_plate_number');
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
