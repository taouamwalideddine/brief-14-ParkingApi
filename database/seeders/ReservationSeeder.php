<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Parking;


class ReservationSeeder extends Seeder
{

    public function run()
    {
        // Get the first user and parking
        $user = User::first();
        $parking = Parking::first();

        // Create sample reservations
        Reservation::create([
            'user_id' => $user->id,
            'parking_id' => $parking->id,
            'start_time' => now()->addHours(1),
            'end_time' => now()->addHours(3),
            'status' => 'active',
        ]);

        Reservation::create([
            'user_id' => $user->id,
            'parking_id' => $parking->id,
            'start_time' => now()->addHours(4),
            'end_time' => now()->addHours(6),
            'status' => 'active',
        ]);

        Reservation::create([
            'user_id' => $user->id,
            'parking_id' => $parking->id,
            'start_time' => now()->addHours(7),
            'end_time' => now()->addHours(9),
            'status' => 'active',
        ]);
    }
}
