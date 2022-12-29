<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Game;
use Illuminate\Support\Arr;

class CreateGame
{
    public function __invoke($rootValue, array $args): Game
    {
        $game = Game::create(Arr::only(
            $args,
            [
                'party_name',
                'budget',
                'date',
                'place',
            ]
        ));

        foreach (Arr::get($args, 'playerNames', []) as $playerName) {
            $game->players()->create([
                'name' => $playerName,
            ]);
        }

        return $game;
    }
}
