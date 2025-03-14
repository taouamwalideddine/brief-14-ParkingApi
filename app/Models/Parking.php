<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = ['name', 'location', 'total_spaces', 'available_spaces'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }   
}
