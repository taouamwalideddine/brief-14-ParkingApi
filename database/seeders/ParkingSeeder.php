<?php

namespace Database\Seeders;

use App\Models\Parking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Parking::create([
            'name' => 'Main Parking Lot',
            'location' => '123 Maain St, City',
            'total_spaces' => 50,
            'available_spaces' => 50,
        ]);

        Parking::create([
            'name' => 'Downtown Parking',
            'location' => '456 Downtown St, City',
            'total_spaces' => 30,
            'available_spaces' => 30,
        ]);
    }

}
