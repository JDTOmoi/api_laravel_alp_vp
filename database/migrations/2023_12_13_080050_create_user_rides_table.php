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
        Schema::create('user_rides', function (Blueprint $table) {
            $table->id('ur_id');
            $table->unsignedBigInteger('ride_id');
            $table->unsignedBigInteger('passanger_id');
            $table->foreign('ride_id')->references('ride_id')->on('rides')->onDelete('cascade');
            $table->foreign('passanger_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->enum('passenger_status', ['0', '1']); //0 = submitted, 1 = accepted
            $table->enum('driver_status', ['0', '1', '2']); //0 = standby, 1 = ongoing, 2 = finished
            $table->text('review');
            $table->unsignedBigInteger('promo_id');
            $table->foreign('promo_id')->references('promo_id')->on('promos')->onDelete('cascade');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rides');
    }
};
