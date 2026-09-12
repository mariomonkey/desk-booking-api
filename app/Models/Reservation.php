<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
protected $fillable = ['user_id', 'desk_id', 'date', 'status'];

public function user()
{
    return $this->belongsTo(User::class);
}

public function desk()
{
    return $this->belongsTo(Desk::class);
}    //
}
