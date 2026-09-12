<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'features', 'is_active'];
    protected $casts = [
        'features' => 'array', 
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}