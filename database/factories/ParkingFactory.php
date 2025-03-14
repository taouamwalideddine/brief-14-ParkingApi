<?php

namespace Database\Factories;

use App\Models\Parking;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParkingFactory extends Factory
{
    protected $model = Parking::class; // Ensure this line is present

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'location' => $this->faker->address,
            'total_spaces' => 50,
            'available_spaces' => 50,
        ];
    }
}
