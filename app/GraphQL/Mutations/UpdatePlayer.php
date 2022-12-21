<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Arr;

class UpdatePlayer
{
    public function __invoke($rootValue, array $args): Player
    {
        $player = Player::findOrFail($args['player_id']);
        if ($args['name']) {
            $player->name = $args['name'];
        }

        $player->save();
        return $player;
    }
}
