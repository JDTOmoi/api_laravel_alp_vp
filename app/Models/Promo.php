<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['promo_id', 'name', 'promo_code', 'promo_exp'];
}
