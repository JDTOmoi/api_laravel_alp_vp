<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Ride extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['ur_id', 'ride_id', 'passanger_id', 'review', 'price'];
}
