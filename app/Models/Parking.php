<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this line
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory; // Add this line

    protected $fillable = [
        'name',
        'location',
        'total_spaces',
        'available_spaces',
    ];

    // Define relationships
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
