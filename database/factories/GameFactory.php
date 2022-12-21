<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'party_name' => $this->faker->name(),
            'budget' => $this->faker->randomFloat(
                nbMaxDecimals: 2,
                min: 5,
                max: 100,
            ),
            'place' => $this->faker->city(),
            'date' => Carbon::now()->addDays(7),
        ];
    }
}
