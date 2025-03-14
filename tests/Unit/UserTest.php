<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation()
    {
        // Create a user
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Assert the user was created
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
    }

    public function test_user_has_reservations()
    {
        // Create a user
        $user = User::factory()->create();

        // Create 3 reservations for the user
        Reservation::factory()->count(3)->create(['user_id' => $user->id]);

        // Assert the user has reservations
        $this->assertCount(3, $user->reservations);
    }
}
