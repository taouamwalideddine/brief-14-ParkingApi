<?php
namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Parking;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class; // Ensure this line is present

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'parking_id' => Parking::factory(),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'status' => 'active',
        ];
    }
}
