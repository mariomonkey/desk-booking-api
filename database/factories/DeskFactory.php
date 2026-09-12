<?php

namespace Database\Factories;

use App\Models\Desk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Desk>
 */
class DeskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        // e.g., "Desk 104" or "Workspace 42"
        'name' => $this->faker->randomElement(['Desk ', 'Workspace ']) . $this->faker->numberBetween(1, 100),
        
        // Encode an array into JSON for the features column
        'features' => json_encode([
            'monitor' => $this->faker->boolean(80), // 80% chance of having a monitor
            'standing' => $this->faker->boolean(30), // 30% chance of being a standing desk
        ]),
        
        'is_active' => true,
    ];
    }
}
