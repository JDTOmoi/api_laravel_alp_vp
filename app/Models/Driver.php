<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['user_id'];

    public function rides(): HasMany{
        return $this->hasMany(Ride::class, 'driver_id', 'driver_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
