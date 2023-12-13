<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['ride_id', 'driver_id', 'status', 'start_location', 'going_time', 'car_model', 'car_plate_number'];
}
