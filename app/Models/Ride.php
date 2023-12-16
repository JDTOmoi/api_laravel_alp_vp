<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ride extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['driver_id', 'status', 'start_location', 'destination_location', 'going_time', 'car_model', 'car_plate_number'];

    public function driver(): BelongsTo{
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }

    public function urs(): HasMany{
        return $this->hasMany(User_Ride::class, 'ride_id', 'ride_id');
    }
}
