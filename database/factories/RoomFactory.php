<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id'=>Hotel::factory(),
            'name'=>$this->faker->word,
            'price_per_night'=>$this->faker->numberBetween(10,1000),
            'max_occupancy'=>$this->faker->numberBetween(1,5),
            'available_rooms'=>$this->faker->numberBetween(10,100)
        ];
    }
}
