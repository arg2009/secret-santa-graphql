<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class GetSelectablePlayersAction
{
    public function execute(Player $player): Collection
    {
        return $player
            ->game
            ->players()
            ->where('id', '!=', $player->id)
            ->whereNotIn(
                'id',
                function (Builder $builder) {
                    return $builder
                        ->from('players')
                        ->select('selected_player_id')
                        ->whereNotNull('selected_player_id');
                }
            )
            ->get();
    }
}
