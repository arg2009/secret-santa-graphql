<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Arr;

class AddPlayerToGame
{
    public function __invoke($rootValue, array $args): Game
    {
        $game = Game::findOrFail($args['game_id']);
        $game->players()->create([
            'name' => $args['name'],
        ]);

        return $game;
    }
}
