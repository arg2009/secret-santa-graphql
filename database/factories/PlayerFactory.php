<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'game_id' => Game::factory(),
        ];
    }

    public function assigned(): static
    {
        return $this->state(fn () => [
            'selected_player_id' => fn (array $attributes) => Player::factory([
                'game_id' => $attributes['game_id'],
            ])
        ]);
    }
}
