<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['user_id', 'name', 'address'];

    public function users(): HasMany{
        return $this->hasMany(User::class, 'user_id', 'user_id');
    }
}
