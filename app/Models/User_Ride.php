<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_Ride extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['ride_id', 'passanger_id', 'review', 'price'];

    public function passanger(): BelongsTo{
        return $this->belongsTo(User::class, 'passanger_id', 'user_id');
    }

    public function ride(): BelongsTo{
        return $this->belongsTo(Ride::class, 'ride_id', 'ride_id');
    }
}
