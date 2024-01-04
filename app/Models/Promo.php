<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'promo_code', 'promo_exp'];

    public function urs(): HasMany{
        return $this->hasMany(User_Ride::class, 'promo_id', 'promo_id');
    }
}
