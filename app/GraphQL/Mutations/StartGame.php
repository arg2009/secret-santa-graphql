<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Actions\GetSelectablePlayersAction;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class StartGame
{
    public function __construct(
        protected GetSelectablePlayersAction $getSelectablePlayersAction
    ) {
    }

    public function __invoke($rootValue, array $args): Game
    {
        /** @var Player $player */
        $player = Player::findOrFail($args['player_id']);

        if ($player->selectedPlayer()->exists()) {
            return $player->game;
        }

        $selectablePlayers = $this->getSelectablePlayersAction->execute($player);

        $selectedPlayer = $selectablePlayers->random();
        $player->selectedPlayer()->associate($selectedPlayer)->save();

        return $player->game;
    }
}
